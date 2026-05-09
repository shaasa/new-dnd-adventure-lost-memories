<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Show;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\StreamedResponse;

class BoardStreamController extends Controller
{
    public function stream(Request $request, Game $game): StreamedResponse
    {
        $player = Auth::user();

        // Svuota output buffer (es. notice PHP in dev) e ne apre uno pulito
        while (ob_get_level() > 0) {
            ob_end_clean();
        }
        ob_start();

        return response()->stream(function () use ($player, $game, $request) {
            $request->session()->save();
            set_time_limit(0);
            ini_set('display_errors', '0');

            $lastHash = null;

            while (true) {
                if (connection_aborted()) {
                    break;
                }

                $shows = Show::where('user_id', $player->id)
                             ->where('game_id', $game->id)
                             ->get(['type', 'show']);

                $hash = md5($shows->toJson());

                if ($hash !== $lastHash) {
                    echo 'data: ' . $shows->toJson() . "\n\n";
                    ob_flush();
                    flush();
                    $lastHash = $hash;
                }

                sleep(2);
            }
        }, 200, [
            'Content-Type'      => 'text/event-stream',
            'Cache-Control'     => 'no-cache',
            'X-Accel-Buffering' => 'no',
        ]);
    }
}