<?php

namespace App\Domains\Players\Actions;

use App\Models\Game;
use App\Models\Player;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;


class GetRandomCharacter
{
    public function execute(Game $game): ?User
    {
        // Controllare se il gioco ha già raggiunto il numero massimo di giocatori
        if($game->players->count() >= $game->players_count) {
            throw new \RuntimeException('The game has already reached the maximum number of players.');
        }

        // Cercare prima un utente con mandatory = 1
        $user = User::where('mandatory', 1)
                    ->whereDoesntHave('players', function (Builder $query) use ($game) {
                        $query->where('game_id', $game->id);
                    })
                    ->inRandomOrder()
                    ->first();

        // Se non trovato, cercare un utente tra gli altri utenti
        if(!$user) {
            $user = User::where('mandatory', '<>', 1)
                        ->whereDoesntHave('players', function (Builder $query) use ($game) {
                            $query->where('game_id', $game->id);
                        })
                        ->inRandomOrder()
                        ->first();
        }

        if ($user) {
            return $user;
        }

        // No eligible users found
        return null;
    }

}
