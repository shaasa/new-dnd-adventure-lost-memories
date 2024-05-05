<?php

namespace App\Http\Controllers;

use App\Domains\Game\Query\GameQuery;
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
        ray($games);
        return view('dashboard', compact('games'));
    }
}
