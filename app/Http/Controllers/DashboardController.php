<?php

namespace App\Http\Controllers;

use App\Domains\Games\Query\GameQuery;
use App\Models\Game;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;


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

        return view('dashboard', compact('games'));
    }

    public function dashboardPlayer(Game $game): Application|Factory|\Illuminate\Foundation\Application|View
    {

        return view('dashboard-player', compact('game'));
    }
}
