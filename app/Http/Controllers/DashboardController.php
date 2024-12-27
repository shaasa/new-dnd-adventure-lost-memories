<?php

namespace App\Http\Controllers;

use App\Domains\Games\Query\GameQuery;
use App\Models\Game;
use App\Models\Show;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
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

        return view('dashboard',[], compact('games'));
    }

    public function dashboardPlayer(Game $game): RedirectResponse|Factory|View|\Illuminate\Foundation\Application
    {
        $player = Auth::user();
        if(null === $player) {
            return redirect()->route('login');
        }
        $character = $player->characters()->wherePivot('game_id',$game->id)->first();
        $shows = Show::where('user_id',$player->id)->where('game_id', $game->id)->get();


        return view('dashboard-player', ['game' => $game],compact( 'game','player','character','shows'));
    }
}
