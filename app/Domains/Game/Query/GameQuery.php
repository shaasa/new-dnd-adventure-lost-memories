<?php

namespace App\Domains\Game\Query;





use App\Models\Game;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class GameQuery extends Game
{
    public function gamesListWithPlayersNumber(): Builder
    {
        return $this->query()->select(['games.id', 'games.name', 'games.players_count', 'games.status',DB::raw('count(players.id) as players_number')])->leftJoin('players', 'games.id', '=', 'players.game_id')->groupBy('games.id', 'games.name', 'games.players_count', 'games.status');
    }
}
