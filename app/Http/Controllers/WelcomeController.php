<?php

namespace App\Http\Controllers;

use App\Domains\Games\Query\GameQuery;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class WelcomeController extends Controller
{
    /**
     * Display a list of open games in welcome page.
     *
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function gamesList(): Application|Factory|View|\Illuminate\Foundation\Application
    {
        $games = app(GameQuery::class);

        $totOpenGames = $games->gameOngoingListWithPlayersNumber()->get();
        return view('welcome', compact( 'totOpenGames'));
    }
}
