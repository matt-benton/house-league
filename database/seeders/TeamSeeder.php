<?php

namespace Database\Seeders;

use App\Models\Team;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Team::create([
            'name' => 'USA',
            'abbreviation' => 'USA',
        ]);

        Team::create([
            'name' => 'Timbers',
            'abbreviation' => 'TIM',
        ]);

        Team::create([
            'name' => 'Tiptop',
            'abbreviation' => 'TIP',
        ]);

        Team::create([
            'name' => 'Gardendale Soccer Club',
            'abbreviation' => 'GSC',
        ]);

        Team::create([
            'name' => 'Expert',
            'abbreviation' => 'EXP',
        ]);

        Team::create([
            'name' => '1 Thru 1',
            'abbreviation' => '1T1',
        ]);

        Team::create([
            'name' => 'Jinns',
            'abbreviation' => 'JIN',
        ]);

        Team::create([
            'name' => 'Lightnings',
            'abbreviation' => 'LHT',
        ]);

        Team::create([
            'name' => 'Hex',
            'abbreviation' => 'Hex',
        ]);

        Team::create([
            'name' => 'Haiti Underwear',
            'abbreviation' => 'HTU',
        ]);

        Team::create([
            'name' => 'Chobios',
            'abbreviation' => 'CHO',
        ]);
    }
}
