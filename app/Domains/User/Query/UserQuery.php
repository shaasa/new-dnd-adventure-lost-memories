<?php

namespace App\Domains\User\Query;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;


class UserQuery extends User
{
    public function playersListForGame(int $gameId): Builder
    {
        return self::query()->whereHas('game', function (Builder $query) use ($gameId) {
            $query->where('game_id', $gameId);
        });
    }
}
