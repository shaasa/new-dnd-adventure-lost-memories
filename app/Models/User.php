<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Barryvdh\LaravelIdeHelper\Eloquent;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Sanctum\PersonalAccessToken;

/**
 * Fattura_elettronica_natura Entity class
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $remember_token
 * @property boolean $is_admin
 * @property Carbon $email_verified_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property int $mandatory
 * @property string|null $race
 * @property string|null $class
 * @property int|null $level
 * @property string|null $alignment
 * @property boolean|null $spells
 * @property-read DatabaseNotificationCollection<int, DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read Collection<int, Player> $players
 * @property-read int|null $players_count
 * @property-read Collection<int, Show> $shows
 * @property-read int|null $shows_count
 * @property-read Collection<int, PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static UserFactory factory($count = null, $state = [])
 * @method static Builder|User newModelQuery()
 * @method static Builder|User newQuery()
 * @method static Builder|User query()
 * @method static Builder|User whereAlignment($value)
 * @method static Builder|User whereClass($value)
 * @method static Builder|User whereCreatedAt($value)
 * @method static Builder|User whereEmail($value)
 * @method static Builder|User whereEmailVerifiedAt($value)
 * @method static Builder|User whereId($value)
 * @method static Builder|User whereIsAdmin($value)
 * @method static Builder|User whereLevel($value)
 * @method static Builder|User whereMandatory($value)
 * @method static Builder|User whereName($value)
 * @method static Builder|User wherePassword($value)
 * @method static Builder|User whereRace($value)
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
        'race',
        'level',
        'class',
        'alignment',
        'mandatory',
        'spells'
    ];

    protected $hidden = [
        'password',
        'remember_token',
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

    public function players(): HasMany
    {
        return $this->hasMany(Player::class);
    }

    public function shows(): HasMany
    {
        return $this->hasMany(Show::class);
    }

    public function isAdmin(): bool
    {
        return $this->is_admin;
    }


}
