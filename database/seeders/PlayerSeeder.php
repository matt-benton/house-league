<?php

namespace Database\Seeders;

use App\Enums\Position;
use App\Models\Player;
use Illuminate\Database\Seeder;

class PlayerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Player::create([
            'name' => "Nature's Alexander",
            'position' => Position::Forward,
            'number' => 11,
        ]);

        Player::create([
            'name' => 'Gumball',
            'position' => Position::Midfielder,
            'number' => 7,
        ]);

        Player::create([
            'name' => 'Chainsaw',
            'position' => Position::Goalkeeper,
            'number' => 1,
        ]);
    }
}
