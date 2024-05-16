<?php

namespace App\Domains\Players\Http\Controllers;


use App\Domains\Players\Actions\GenerateToken;
use App\Domains\Players\Actions\GetRandomCharacter;
use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\Player;
use App\Notifications\LoginLinkNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use NotificationChannels\Discord\Discord;


class PlayerCrudController extends Controller
{
    /**
     *
     *
     * @param Request $request
     * @param GetRandomCharacter $getRandomCharacter
     * @param GenerateToken $generateToken
     * @return RedirectResponse
     */
    public function insert(Request $request, GetRandomCharacter $getRandomCharacter, GenerateToken $generateToken): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'string|required|max:255',
            'game_id' => 'integer|exists:games,id',
            'discord_id' => 'required|integer',
            'discord_name' => 'required|string|max:255',
        ]);

        $game = Game::find($data['game_id']);
        try {
            $character = $getRandomCharacter->execute($game);
            $token = $generateToken->execute();
            if ($character === null) {
                throw new \RuntimeException('Non è stato possibile trovare un personaggio adeguato');
            }
            $data['user_id'] = $character->id;
            $data['token'] = $token;
            $data['discord_private_channel_id'] = app(Discord::class)->getPrivateChannel($data['discord_id']);
            Player::create($data);
        } catch (\Exception $exception) {
            ray($exception->getMessage());
        }
        return redirect()->route('game.page', ['game' => $game->id]);
    }

    public function page(Player $player): RedirectResponse
    {
        return redirect()->route('player.page', ['player' => $player]);
    }

    public function update(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'id' => 'required|integer|exists:players,id',
            'game_id' => 'required|integer|exists:game,id',
            'name' => 'string|nullable|max:255',
            'discord_id' => 'nullable|integer',
            'discord_name' => 'nullable|string|max:255',
            'user_id' => 'nullable|integer|exists:users,id',
        ]);
        $game = Game::find($data['game_id']);
        try {
            Player::upsert($data, 'id');
        } catch (\Exception $exception) {
            ray($exception->getMessage());
        }
        return redirect()->route('game.page', ['game' => $game]);
    }

    public function delete(Player $player): RedirectResponse
    {

        $game = $player->game;
        try {
            $player->delete();
        } catch (\Exception $exception) {
            ray($exception->getMessage());
        }
        return redirect()->route('game.page', ['game' => $game]);
    }

}
