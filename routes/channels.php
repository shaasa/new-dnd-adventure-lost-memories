<?php

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Log;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/
Log::info('Entering channels.php file');
Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    Log::info('Entering App.Models.User.{id}');
    return (int)$user->id === (int)$id || $user->isAdmin();
});

Broadcast::channel('App.Models.Game.{gameId}', function ($user, $gameId) {
    Log::info("Attempting to authorize channel for Game ID: {$gameId}, User ID: {$user->id}");
    if (!$user) {
        return false;
    }
    try {
        if ($user->isAdmin() || $user->games()->where('id', $gameId)->exists()) {
            return ['id' => $user->id, 'name' => $user->name, 'gameId' => $gameId, 'is_admin' => $user->is_admin];
        }
    } catch (\Exception $e) {
        Log::error('Errore nell\'autorizzazione del canale: ' . $e->getMessage());
    }
    return false;
});
