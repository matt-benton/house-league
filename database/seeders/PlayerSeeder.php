<?php

namespace Database\Seeders;

use App\Enums\Position;
use App\Models\Player;
use App\Models\Team;
use Illuminate\Database\Seeder;

class PlayerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $timbers = Team::where('abbreviation', 'TIM')->first();

        Player::create([
            'name' => "Nature's Alexander",
            'position' => Position::Forward,
            'number' => 11,
            'team_id' => $timbers->id,
        ]);

        Player::create([
            'name' => 'Gumball',
            'position' => Position::Midfielder,
            'number' => 7,
            'team_id' => $timbers->id,
        ]);

        Player::create([
            'name' => 'Chainsaw',
            'position' => Position::Goalkeeper,
            'number' => 1,
            'team_id' => $timbers->id,
        ]);
    }
}
