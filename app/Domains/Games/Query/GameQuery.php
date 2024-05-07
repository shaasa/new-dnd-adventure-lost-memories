<?php

namespace App\Domains\Games\Query;

use App\Models\Game;
use App\Models\Player;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;


/**
 *
 *
 * @mixin Builder
 * @property int $id
 * @property string|null $name
 * @property-read int|null $players_count
 * @property string $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, Player> $players
 * @method static Builder|GameQuery newModelQuery()
 * @method static Builder|GameQuery newQuery()
 * @method static Builder|GameQuery query()
 * @method static Builder|GameQuery whereCreatedAt($value)
 * @method static Builder|GameQuery whereId($value)
 * @method static Builder|GameQuery whereName($value)
 * @method static Builder|GameQuery wherePlayersCount($value)
 * @method static Builder|GameQuery whereStatus($value)
 * @method static Builder|GameQuery whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class GameQuery extends Game
{
    public function gamesListWithPlayersNumber(): Builder
    {
        return $this->query()->select(['games.id', 'games.name', 'games.players_count', 'games.status',DB::raw('count(players.id) as players_number')])->leftJoin('players', 'games.id', '=', 'players.game_id')->groupBy('games.id', 'games.name', 'games.players_count', 'games.status');
    }

    public function gameOngoingListWithPlayersNumber(): Builder
    {
        return $this->gamesListWithPlayersNumber()->whereNotIn('status', ['finished', 'suspended']);
    }
}
