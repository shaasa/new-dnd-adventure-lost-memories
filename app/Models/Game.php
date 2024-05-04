<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Game extends Model
{
    use HasFactory;

    protected $table = 'games';
    protected $fillable = ['players_count'];

    public function players(): HasMany
    {
        return $this->hasMany(Player::class);
    }
}
