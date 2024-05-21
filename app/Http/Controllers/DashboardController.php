<?php

namespace App\Http\Controllers;

use App\Domains\Games\Query\GameQuery;
use App\Models\Player;
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

    public function dashboardPlayer(Player $player): Application|Factory|\Illuminate\Foundation\Application|View
    {

        return view('dashboard-player', compact('player'));
    }
}
