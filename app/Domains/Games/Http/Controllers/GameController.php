<?php

namespace App\Domains\Games\Http\Controllers;


use App\Enums\GameStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\Game;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class GameController extends Controller
{
    /**
     *
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function insert(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'string|required|max:255',
            'players_count' =>  'integer|min:1',
            'status' =>  [Rule::enum(GameStatusEnum::class)]
        ]);

        try {
            Game::create($data);
        }catch (\Exception $exception){
            ray($exception->getMessage());
        }
        return redirect()->route('dashboard');
    }

    public function page(Game $game): Application|Factory|View|\Illuminate\Foundation\Application
    {
        $players = $game->players;

        return view('game', ['game' => $game]);
    }

    public function update(Request $request): RedirectResponse
    {

        $data = $request->validate([
            'id' => 'integer|exists:games,id',
            'name' => 'string|required|max:255',
            'players_count' =>  'integer|min:1',
            'status' =>  [Rule::enum(GameStatusEnum::class)]
        ]);

        try {
            Game::upsert($data,'id');
        }catch (\Exception $exception){
            ray($exception->getMessage());
        }
        return redirect()->route('dashboard');
    }
}
