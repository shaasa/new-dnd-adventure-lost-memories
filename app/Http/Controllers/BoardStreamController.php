<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Show;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BoardStreamController extends Controller
{
    public function stream(Request $request, Game $game): JsonResponse
    {
        $player = Auth::user();

        $shows = Show::where('user_id', $player->id)
                     ->where('game_id', $game->id)
                     ->get(['type', 'show']);

        return response()->json($shows);
    }
}
