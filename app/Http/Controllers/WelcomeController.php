<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class WelcomeController extends Controller
{
    /**
     * Display a list of open games in welcome page.
     *
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function gamesList(): Application|Factory|View|\Illuminate\Foundation\Application
    {
        $games = app(Game::class);
        $totOpenGames = $games->whereNotIn('status', ['finished', 'suspended'])->get();
        return view('welcome', compact( 'totOpenGames'));
    }
}
