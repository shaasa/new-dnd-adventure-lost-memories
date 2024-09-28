<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 *
 *
 * @property int $id
 * @property int $user_id
 * @property int $game_id
 * @property string $type
 * @property boolean $show
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Game $game
 * @property-read User $user
 * @method static Builder|Show newModelQuery()
 * @method static Builder|Show newQuery()
 * @method static Builder|Show query()
 * @method static Builder|Show whereCreatedAt($value)
 * @method static Builder|Show whereGameId($value)
 * @method static Builder|Show whereId($value)
 * @method static Builder|Show whereType($value)
 * @method static Builder|Show whereUpdatedAt($value)
 * @method static Builder|Show whereUserId($value)
 * @mixin \Eloquent
 */
class Show extends Model
{
    use HasFactory;

    protected $table = 'shows';
    protected $fillable = ['user_id', 'game_id', 'type', 'show'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class);
    }
}
