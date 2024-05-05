<?php

namespace App\Domains\Game\Controller;


use App\Enums\GameStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\Game;
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
        ray($data);
        try {
            $game = Game::create($data);
            ray($game);
            ray($data);
        }catch (\Exception $exception){
            ray($exception->getMessage());
        }
        return redirect()->route('dashboard');
    }
}
