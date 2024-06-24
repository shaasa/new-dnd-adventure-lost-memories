<?php

use Illuminate\Support\Facades\Broadcast;

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

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int)$user->id === (int)$id;
});
Broadcast::channel('admin', function ($user) {
    return (int)$user->is_admin === 1;
});

Broadcast::channel('App.Models.Game.{gameId}', function ($user, $gameId) {

    if ($user) {
        return ['id' => $user->id, 'name' => $user->name, 'gameId' => $gameId, 'is_admin' => false];
    }
    return false;
});
