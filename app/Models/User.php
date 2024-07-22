<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Database\Factories\UserFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Sanctum\PersonalAccessToken;

/**
 * Fattura_elettronica_natura Entity class
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $token
 * @property string $remember_token
 * @property boolean $is_admin
 * @property Carbon $email_verified_at
 * @property string|null $discord_name
 * @property string|null $discord_id
 * @property string|null $discord_private_channel_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read DatabaseNotificationCollection<int, DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read Collection<int, Show> $shows
 * @property-read int|null $shows_count
 * @property-read Collection<int, PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static UserFactory factory($count = null, $state = [])
 * @method static Builder|User newModelQuery()
 * @method static Builder|User newQuery()
 * @method static Builder|User query()
 * @method static Builder|User whereAlignment($value)
 * @method static Builder|User whereCreatedAt($value)
 * @method static Builder|User whereEmail($value)
 * @method static Builder|User whereEmailVerifiedAt($value)
 * @method static Builder|User whereId($value)
 * @method static Builder|User whereIsAdmin($value)
 * @method static Builder|User whereDiscordId($value)
 * @method static Builder|User whereDiscordName($value)
 * @method static Builder|User whereDiscordPrivateChannelId($value)
 * @method static Builder|User whereName($value)
 * @method static Builder|User wherePassword($value)
 * @method static Builder|User whereRememberToken($value)
 * @method static Builder|User whereUpdatedAt($value)
 * @mixin Eloquent
 */

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'token',
        'discord_name',
        'discord_id',
        'discord_private_channel_id',
        'is_admin',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'token'
    ];

    public function scopeInGame(Builder $query, $gameId): Builder
    {
        return $query->whereHas('games', function ($q) use ($gameId) {
            $q->where('games.id', $gameId);
        })->with('characters');
    }

    public function scopeNotInGame(Builder $query, $gameId): Builder
    {
        return $query->whereDoesntHave('games', function ($q) use ($gameId) {
            $q->where('games.id', $gameId);
        });
    }

    public function scopeIsPlayer(Builder $query): Builder
    {
        return $query->where('is_admin', 0);
    }

    public function scopeIsMaster(Builder $query): Builder
    {
        return $query->where('is_admin', 1);
    }

    public function games(): BelongsToMany
    {
        return $this->belongsToMany(Game::class, 'users_games_characters')->withPivot('character_id');
    }

    public function characters(): BelongsToMany
    {
        return $this->belongsToMany(Character::class, 'users_games_characters')->withPivot('game_id');
    }

    public function shows(): HasMany
    {
        return $this->hasMany(Show::class);
    }

    public function isAdmin(): bool
    {
        return $this->is_admin;
    }

    public function getRedirectRoute(): string
    {
        return match((int)$this->isAdmin()) {
            0 => 'player',
            1 => 'admin'
        };
    }

    public function routeNotificationForDiscord(): string
    {
        return $this->discord_private_channel_id;

    }

    public function generateLoginLink(Game $game): string
    {
        return URL::temporarySignedRoute('verify-login', now()->addDay(2), ['token' => $this->token, 'game' => $game]);
    }

}
