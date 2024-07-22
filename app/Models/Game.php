<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;

/**
 *
 *
 * @property int $id
 * @property string|null $name
 * @property-read int|null $players_count
 * @property string $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, User> $users
 * @method static Builder|Game newModelQuery()
 * @method static Builder|Game newQuery()
 * @method static Builder|Game query()
 * @method static Builder|Game whereCreatedAt($value)
 * @method static Builder|Game whereId($value)
 * @method static Builder|Game whereName($value)
 * @method static Builder|Game wherePlayersCount($value)
 * @method static Builder|Game whereStatus($value)
 * @method static Builder|Game whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Game extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'games';
    protected $fillable = ['players_count', 'status', 'name'];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'users_games_characters')->withPivot('character_id');
    }

    public function characters(): BelongsToMany
    {
        return $this->belongsToMany(Character::class, 'users_games_characters')->withPivot('user_id');
    }

    public function shows(): HasMany
    {
        return $this->hasMany(Show::class);
    }
}
