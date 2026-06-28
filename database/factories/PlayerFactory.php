<?php

namespace Database\Factories;

use App\Enums\Position;
use App\Models\Player;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Player>
 */
class PlayerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'position' => $this->faker->randomElement(Position::values()),
            'number' => $this->faker->numberBetween(1, 99),
        ];
    }
}
