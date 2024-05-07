<?php

namespace App\Domains\Players\Query;

use App\Models\Player;
use Illuminate\Database\Eloquent\Builder;


class PlayerQuery extends Player
{
    public function playersListForGame(int $gameId): Builder
    {
        return self::query()->join('games', 'games.id', '=', 'players.game_id');
    }
}
