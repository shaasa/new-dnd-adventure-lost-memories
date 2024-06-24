<?php

namespace App\Http\Controllers\User;



use App\Domains\User\Actions\GenerateToken;
use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\User;
use App\Notifications\LoginLinkNotification;
use Illuminate\Http\RedirectResponse;



class UserLoginController extends Controller
{

    public function refreshToken(User $player, Game $game, GenerateToken $generateToken): RedirectResponse
    {
        $token = $generateToken->execute();
        $player->update(['token' => $token]);
        return redirect()->route('game.page', ['game' => $game->id]);
    }

    public function sendToken(User $player, Game $game,): RedirectResponse
    {
        try {
            $player->notify(new LoginLinkNotification());
        }catch (\Throwable $exception){
            ray($exception->getMessage());
        }
        return redirect()->route('game.page', ['game' => $game->id]);
    }

}
