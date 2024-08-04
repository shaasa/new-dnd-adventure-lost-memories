<?php

namespace App\Domains\User\Services;


use App\Domains\User\Actions\GenerateToken;

use App\Domains\User\Actions\GetRandomCharacter;
use App\Domains\User\Data\UserCreateDTO;
use App\Domains\User\Requests\UserCreateRequest;
use App\Domains\User\Requests\UserUpdateRequest;
use App\Enums\TypeEnum;
use App\Models\Game;
use App\Models\Show;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use LaravelIdea\Helper\App\Models\_IH_User_C;
use NotificationChannels\Discord\Discord;
use Str;

class UserService
{

    public function create(UserCreateRequest $request): void
    {
        $generateToken = app(GenerateToken::class);
        $data = $request->all();
        $discordPrivateChannelId = app(Discord::class)->getPrivateChannel($data['discord_id']);

        $dto = new UserCreateDTO(
            $data['name'],
            $data['name'] . '@beatriceweb.it',
            'ps' . $data['name'] . '-1',
            'ps' . $data['name'] . '-1',
            $data['discord_id'],
            $data['discord_name'],
            $discordPrivateChannelId,
            $data['is_admin'] ?? 0,
            $generateToken->execute()
        );
        $user = User::create(
            $dto->toArray()
        );
        if ($data['game_id'] !== null) {
            $game = Game::find($data['game_id']);
            $this->playGame($user, $game);
        }
    }

    public function playGame(User $user, Game $game): void
    {
        try {
            $getRandomCharacter = app(GetRandomCharacter::class);
            $character = $getRandomCharacter->execute($game);
            if ($character === null) {
                throw new \RuntimeException('Non è stato possibile trovare un personaggio adeguato');
            }

            $user->games()->attach($game->id, ['character_id' => $character->id], true);
            foreach (TypeEnum::cases() as $type) {
                Show::create([
                    'user_id' => $user->id,
                    'type' => $type->value,
                    'game_id' => $game->id,
                    'show' => false
                ]);
            }
        } catch (\Exception $exception) {
            ray($exception->getMessage());
        }
    }

    public function update(UserUpdateRequest $request, User $user): void
    {
        $data = $request->validated();
        $user->update($data);
    }

    public function attachUserGame(int $user_id, int $game_id): Model|Collection|array|User|_IH_User_C|null
    {
        $user = User::find($user_id);
        $game = Game::find($game_id);
        $this->playGame($user, $game);
        return $user;
    }
}
