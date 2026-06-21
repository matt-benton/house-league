<?php

namespace Database\Factories;

use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Team>
 */
class TeamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'abbreviation' => $this->faker->randomLetter().$this->faker->randomLetter().$this->faker->randomLetter(),
            'name' => ucfirst($this->faker->word()),
        ];
    }
}
