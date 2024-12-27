<?php

namespace App\Http\Controllers;


use App\Enums\GameStatusEnum;
use App\Http\Controllers\Game\GameController;
use App\Models\Game;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class GameCrudController extends Controller
{
    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'string|required|max:255',
            'players_count' => 'integer|min:1',
            'status' => [Rule::enum(GameStatusEnum::class)]
        ]);


        Game::create($data);

        return redirect()->route('dashboard');
    }

    public function update(Request $request): RedirectResponse
    {

        $data = $request->validate([
            'id' => 'integer|exists:games,id',
            'name' => 'string|required|max:255',
            'players_count' => 'integer|min:1',
            'status' => [Rule::enum(GameStatusEnum::class)]
        ]);

        Game::upsert($data, 'id');

        return redirect()->route('dashboard');
    }
}
