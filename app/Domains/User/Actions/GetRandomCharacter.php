<?php

namespace App\Domains\User\Actions;

use App\Models\Character;
use App\Models\Game;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;


class GetRandomCharacter
{
    public function execute(Game $game): ?User
    {
        // Check if the game has reached the maximum number of players
        if($game->characters()->count() >= $game->players_count) {
            throw new \RuntimeException('The game has already reached the maximum number of players.');
        }

        // Mandatory character first
        $character = Character::where('mandatory', 1)
                    ->whereDoesntHave('users', function (Builder $query) use ($game) {
                        $query->where('game_id', $game->id);
                    })
                    ->inRandomOrder()
                    ->first();

        // Then random character
        if(!$character) {
            $user = User::where('mandatory', '<>', 1)
                        ->whereDoesntHave('users', function (Builder $query) use ($game) {
                            $query->where('game_id', $game->id);
                        })
                        ->inRandomOrder()
                        ->first();
        }

        if ($character) {
            return $character;
        }

      
        return null;
    }

}
