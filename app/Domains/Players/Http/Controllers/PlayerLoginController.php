<?php

namespace App\Domains\Players\Http\Controllers;


use App\Domains\Players\Actions\GenerateToken;
use App\Domains\Players\Actions\GetRandomCharacter;
use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\Player;
use App\Notifications\LoginLinkNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use NotificationChannels\Discord\Discord;


class PlayerLoginController extends Controller
{

    public function refreshToken(Player $player, GenerateToken $generateToken): RedirectResponse
    {
        $token = $generateToken->execute();
        $player->update(['token' => $token]);
        return redirect()->route('game.page', ['game' => $player->game_id]);
    }

    public function sendToken(Player $player): RedirectResponse
    {
        try {
            $player->notify(new LoginLinkNotification());
        }catch (\Throwable $exception){
            ray($exception->getMessage());
        }
        return redirect()->route('game.page', ['game' => $player->game_id]);
    }

}
