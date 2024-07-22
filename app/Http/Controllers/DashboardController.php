<?php

namespace App\Http\Controllers;

use App\Domains\Games\Query\GameQuery;
use App\Models\Game;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    /**
     * Passa la lista delle partite create alla dashboard
     *
     *
     * @return Application|Factory|\Illuminate\Foundation\Application|View
     */
    public function dashboard(): Application|Factory|\Illuminate\Foundation\Application|View
    {
        $games = app(GameQuery::class)->gamesListWithPlayersNumber()->get();
        $user = Auth::user();
        $authToken = $user?->createToken('authToken')->plainTextToken;
        return view('dashboard',['authToken' => $authToken], compact('games'));
    }

    public function dashboardPlayer(Game $game): Application|Factory|\Illuminate\Foundation\Application|View
    {
        $user = Auth::user();
        $authToken = $user?->createToken('authToken')->plainTextToken;
        return view('dashboard-player', ['game' => $game],compact('authToken'));
    }
}
