<?php

namespace App\Http\Controllers\User;


use App\Domains\User\Requests\UserGameRequest;
use App\Domains\User\Services\UserService;
use App\Enums\TypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Game\GameController;
use App\Models\Game;
use App\Models\Show;
use App\Models\User;
use Illuminate\Http\RedirectResponse;


class UserGameController extends Controller
{
    public function delete(User $user, Game $game): RedirectResponse
    {
        $user->games()->detach($game);
        return redirect()->route('game.page', ['game' => $game->id]);
    }

    public function toggle(User $user, TypeEnum $fase, Game $game): RedirectResponse
    {
        $show = Show::where('game_id', $game->id)
                    ->where('user_id', $user->id)
                    ->where('type', $fase->value)
                    ->first();

        $show?->update(['show' => !$show->show]);

        return redirect()->route('game.page', ['game' => $game->id]);
    }

    public function attachUserGame(UserGameRequest $request, UserService $service)
    {
        $data = $request->all();
        $player = $service->attachUserGame($data['user_id'], $data['game_id']);
        $game = Game::find($data['game_id']);
        if(null === $game){
            throw new \Exception('Game not found');
        }
        return app(GameController::class)->page($game);
    }

}
