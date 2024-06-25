<?php

namespace App\Domains\User\Data;

final readonly class UserCreateDTO
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password,
        public string $password_confirmation,
        public string $discord_id,
        public string $discord_name,
        public string $discord_private_chanel_id,
        public bool $is_admin,
        public string $token
    ) {
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'password_confirmation' => $this->password_confirmation,
            'discord_id' => $this->discord_id,
            'discord_name' => $this->discord_name,
            'discord_private_channel_id' => $this->discord_private_chanel_id,
            'is_admin' => $this->is_admin,
            'token' => $this->token,
        ];
    }
}