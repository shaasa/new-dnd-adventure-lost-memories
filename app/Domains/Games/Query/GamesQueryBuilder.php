<?php


namespace App\Domains\Games\Query;



use App\Models\Game;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class GamesQueryBuilder extends Game
{
    public function getGamesListWithPlayersNumber(): Builder
    {
        return $this->query()->select(['games.id','games.name','games.players_count','games.status', DB::raw('count(players.id) as players_number')])->join('players', 'games.id', '=', 'players.game_id')->groupBy(['games.id', 'games.name', 'games.players_count', 'games.status']);
    }
}
