<?php

namespace App\Domains\User\Actions;

use App\Models\Character;
use App\Models\Game;
use Illuminate\Database\Eloquent\Builder;


class GetRandomCharacter
{
    public function execute(Game $game): ?Character
    {
        // Check if the game has reached the maximum number of players
        if($game->characters()->count() >= $game->players_count) {
            throw new \RuntimeException('The game has already reached the maximum number of players.');
        }

        // Mandatory character first
        $character = Character::query()->where('mandatory', 1)
                    ->whereDoesntHave('users', function (Builder $query) use ($game) {
                        $query->where('game_id', $game->id);
                    })
                    ->inRandomOrder()
                    ->first();

        // Then random character
        if(!$character) {
            $character = Character::query()->where('mandatory', '<>', 1)
                        ->whereDoesntHave('users', function (Builder $query) use ($game) {
                            $query->where('game_id', $game->id);
                        })
                        ->inRandomOrder()
                        ->first();
        }
        /**
         * @var $character Character
         */
        if ($character) {
            return $character;
        }

      
        return null;
    }

}
