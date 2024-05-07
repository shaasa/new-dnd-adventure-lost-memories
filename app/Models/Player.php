<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 *
 *
 * @property int $id
 * @property int $game_id
 * @property string $discord_name
 * @property string $discord_id
 * @property int $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Game $game
 * @property-read User $user
 * @method static Builder|Player newModelQuery()
 * @method static Builder|Player newQuery()
 * @method static Builder|Player query()
 * @method static Builder|Player whereCreatedAt($value)
 * @method static Builder|Player whereDiscordId($value)
 * @method static Builder|Player whereDiscordName($value)
 * @method static Builder|Player whereGameId($value)
 * @method static Builder|Player whereId($value)
 * @method static Builder|Player whereUpdatedAt($value)
 * @method static Builder|Player whereUserId($value)
 * @mixin \Eloquent
 */
class Player extends Model
{
    use HasFactory;

    protected $table =  'players';
    protected $fillable = ['name','discord_name', 'discord_id', 'user_id', 'game_id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class);
    }

    public function players(): HasMany
    {
        return $this->hasMany(__CLASS__);
    }
}
