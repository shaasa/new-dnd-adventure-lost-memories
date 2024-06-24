<?php

namespace Database\Factories;

use App\Models\Game;
use App\Models\Player;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class PlayerFactory extends Factory
{
    protected $model = Player::class;

    public function definition(): array
    {
        return [
            'discord_name' => $this->faker->name(),
            'discord_id' => $this->faker->word(),
            'discord_private_channel_id' => $this->faker->word(),
            'token' => Str::random(10),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'name' => $this->faker->name(),

            'game_id' => Game::factory(),
            'user_id' => User::factory(),
        ];
    }
}
