<?php

namespace App\Domains\Players\Http\Controllers;


use App\Enums\TypeEnum;
use App\Events\ToggleCharacterSheet;
use App\Http\Controllers\Controller;
use App\Models\Player;
use App\Models\Show;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;


class PlayerGameController extends Controller
{
    public function toggle(Player $player, TypeEnum $fase): RedirectResponse
    {

        try {
            $show = Show::where('game_id', $player->game_id)
                        ->where('user_id', $player->user_id)
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


}
