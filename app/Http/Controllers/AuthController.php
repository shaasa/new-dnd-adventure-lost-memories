<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Show;
use App\Models\User;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;


class AuthController extends Controller
{


    public function login(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
        ]);
        User::where('token', '=', $data['token'])->first()?->sendLoginLink();
        session()?->flash('success', true);
        return redirect()->back();
    }

    public function verifyLogin(Request $request, string $token, Game $game): RedirectResponse
    {
        $player = User::where('token', $token)->firstOrFail();
        abort_unless($request->hasValidSignature() && $token, 401);

        Auth::login($player, true);

        if ($player->getRedirectRoute() === 'admin') {

            return redirect()->route('dashboard');
        }

        return $this->getPlayerDashboard($player, $game);

    }

    private function getPlayerDashboard(User $player, Game $game): RedirectResponse
    {
        $character = $player->characters()->wherePivot('game_id', $game->id)->first();
        $shows = Show::where('user_id', $player->id)->where('game_id', $game->id)->get();

        return redirect()->route('dashboard.player', [
            'game' => $game->id,
            'player' => $player->id,
            'character' => $character?->id,
            'shows' => $shows
        ]);
    }
}
