<?php

namespace App\Domains\Games\Query;

use App\Models\Game;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;


/**
 * @method static Builder|GameQuery newModelQuery()
 * @method static Builder|GameQuery newQuery()
 * @method static Builder|GameQuery query()
 * @mixin \Eloquent
 */
class GameQuery extends Game
{
    public function gamesListWithPlayersNumber(): Builder
    {
        return $this->query()->select(['games.id', 'games.name', 'games.players_count', 'games.status',DB::raw('count(user_id) as players_number')])->leftJoin('users_games_characters', 'games.id', '=', 'users_games_characters.game_id')->groupBy('games.id', 'games.name', 'games.players_count', 'games.status');
    }

    public function gameOngoingListWithPlayersNumber(): Builder
    {
        return $this->gamesListWithPlayersNumber()->whereNotIn('status', ['finished', 'suspended']);
    }
}
