<?php

namespace App\Domains\User\Actions;


use App\Models\User;
use Illuminate\Support\Str;


class GamePageAttributes
{
    public function execute(int $gameId): array
    {
        $players = User::inGame($gameId)
            ->with(['shows' => fn($q) => $q->where('game_id', $gameId)])
            ->get();
        $users = User::isPlayer()->notInGame($gameId)->get();
        return [ $players, $users];
    }

}
