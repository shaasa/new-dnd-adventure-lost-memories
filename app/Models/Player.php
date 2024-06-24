<?php

namespace App\Models;


use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;

/**
 *
 *
 * @property int $id
 * @property int $game_id
 * @property string $discord_name
 * @property string $discord_id
 * @property string $discord_private_channel_id
 * @property string $token
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
 * @mixin Eloquent
 */
class Player extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'players';
    protected $fillable = ['name', 'discord_name', 'discord_id', 'user_id', 'game_id', 'token', 'discord_private_channel_id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class, 'game_id');
    }

    public function players(): HasMany
    {
        return $this->hasMany(__CLASS__);
    }

    public function routeNotificationForDiscord(): string
    {
        return $this->discord_private_channel_id;

    }

    public function generateLoginLink(): string
    {
        return URL::temporarySignedRoute('verify-login', now()->addDay(2), ['token' => $this->token]);
    }
}
