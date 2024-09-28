<?php

namespace App\Domains\User\Actions;


use App\Models\User;
use Illuminate\Support\Str;


class GamePageAttributes
{
    public function execute(int $gameId): array
    {
        $players = User::inGame($gameId)->get();
        $users = User::isPlayer()->notInGame($gameId)->get();
        return [ $players, $users];
    }

}
