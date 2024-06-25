<?php

namespace App\Http\Controllers\User;


use App\Domains\User\Requests\UserGameRequest;
use App\Domains\User\Services\UserService;
use App\Enums\TypeEnum;
use App\Events\ToggleCharacterSheet;
use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\Show;
use App\Models\User;
use Illuminate\Http\RedirectResponse;


class UserGameController extends Controller
{
    public function toggle(User $player, Game $game, TypeEnum $fase): RedirectResponse
    {

        try {
            $show = Show::where('game_id', $game->id)
                ->where('user_id', $player->id)
                ->where('type', $fase->value)
                ->first();

            $toggle = !$show?->show;

            $show?->update(['show' => $toggle]);

            ToggleCharacterSheet::dispatch($player, $fase, $toggle);

            return redirect()->route('game.page', ['game' => $player->game_id]);
        } catch (\Exception $e) {
            // Log the error
            \Log::error('Error dispatching event: ' . $e->getMessage());

            // Optionally, return an error response
            return redirect()->route('game.page', ['game' => $player->game_id]);
        }


    }

    public function attachUserGame(UserGameRequest $request, UserService $service): RedirectResponse
    {
        $data = $request->all();
        $player = $service->attachUserGame($data['user_id'], $data['game_id']);
        return redirect()->route('player.page', ['player' => $player]);
    }

}
