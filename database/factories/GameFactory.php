<?php

namespace Database\Factories;

use App\Models\Game;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Game>
 */
class GameFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $teams = Team::query()->inRandomOrder()->limit(2)->get();

        return [
            'home_team_id' => $teams[0]->id,
            'away_team_id' => $teams[1]->id,
        ];
    }
}
