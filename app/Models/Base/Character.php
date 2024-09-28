<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\Game;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Character
 * 
 * @property int $id
 * @property string $name
 * @property bool $mandatory
 * @property string|null $race
 * @property string|null $class
 * @property int $level
 * @property string $alignment
 * @property bool $spells
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Game[] $games
 * @property Collection|User[] $users
 *
 * @package App\Models\Base
 */
class Character extends Model
{
	protected $table = 'characters';

	protected $casts = [
		'mandatory' => 'bool',
		'level' => 'int',
		'spells' => 'bool'
	];

	public function games()
	{
		return $this->belongsToMany(Game::class, 'users_games_characters')
					->withPivot('user_id')
					->withTimestamps();
	}

	public function users()
	{
		return $this->belongsToMany(User::class, 'users_games_characters')
					->withPivot('game_id')
					->withTimestamps();
	}
}
