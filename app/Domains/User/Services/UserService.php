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
use NotificationChannels\Discord\Discord;
use Str;

class UserService
{

    public function create(UserCreateRequest $request): void
    {
        $generateToken = app(GenerateToken::class);
        $data = $request->validated();
        $dto = new UserCreateDTO(
            $data['name'],
            $data['name'] . '@beatriceweb.it',
            'ps' . $data['name'] . '-1',
            'ps' . $data['name'] . '-1',
            $data['discord_id'],
            $data['discord_name'],
            app(Discord::class)->getPrivateChannel($data['discord_id']),
            $data['is_admin'],
            $generateToken->execute()
        );
        User::create(
            $dto->toArray()
        );

    }

    public function playGame(User $user, Game $game): void
    {
        try {
            $getRandomCharacter = app(GetRandomCharacter::class);
            $character = $getRandomCharacter->execute($game);
            if ($character === null) {
                throw new \RuntimeException('Non è stato possibile trovare un personaggio adeguato');
            }

            $user->games()->attach($game->id,['character_id' => $character->id]) ;
            foreach (TypeEnum::cases() as $type) {
                Show::create([
                    'user_id' => $character->id,
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
}