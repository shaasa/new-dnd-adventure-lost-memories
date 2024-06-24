<?php

namespace Database\Factories;

use App\Models\Game;
use App\Models\Show;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ShowFactory extends Factory
{
    protected $model = Show::class;

    public function definition(): array
    {
        return [
            'type' => $this->faker->word(),
            'show' => $this->faker->boolean(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'user_id' => User::factory(),
            'game_id' => Game::factory(),
        ];
    }
}
