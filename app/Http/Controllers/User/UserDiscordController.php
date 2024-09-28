<?php

namespace App\Http\Controllers\User;


use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\PrivateDiscordMessage;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;



class UserDiscordController extends Controller
{
    public function discord(int $playerId): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        return view('players.discord');
    }

    public function sendDiscordMessage(User $player, string $message): bool
    {
        try {

            $player->notify(new PrivateDiscordMessage($message));

        }catch (\Throwable $exception){
            return false;
        }
        return true;
    }
}
