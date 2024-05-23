<?php

use App\Models\Player;
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
Broadcast::channel('App.Models.Player.{id}', function ($player, $id) {
    return (int)$player->id === (int)$id;
});
Broadcast::channel('App.Models.Game.{gameId}', function ($user, $gameId) {
    $player = Player::where('user_id', $user->id)->where('game_id', $gameId)->first();
    if ($player !== null) {
        return ['id' => $player->id];
    }
    if ($user->is_admin === 1) {
        return ['id' => 'admin'];
    }
    return false;
});
