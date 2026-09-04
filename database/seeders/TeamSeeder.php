<?php

namespace Database\Seeders;

use App\Models\League;
use App\Models\Team;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $leagueId = League::query()->where('name', 'House League')->value('id');

        Team::create([
            'name' => 'USA',
            'abbreviation' => 'USA',
            'league_id' => $leagueId,
        ]);

        Team::create([
            'name' => 'Timbers',
            'abbreviation' => 'TIM',
            'league_id' => $leagueId,
        ]);

        Team::create([
            'name' => 'Tiptop',
            'abbreviation' => 'TIP',
            'league_id' => $leagueId,
        ]);

        Team::create([
            'name' => 'Gardendale Soccer Club',
            'abbreviation' => 'GSC',
            'league_id' => $leagueId,
        ]);

        Team::create([
            'name' => 'Expert',
            'abbreviation' => 'EXP',
            'league_id' => $leagueId,
        ]);

        Team::create([
            'name' => '1 Thru 1',
            'abbreviation' => '1T1',
            'league_id' => $leagueId,
        ]);

        Team::create([
            'name' => 'Jinns',
            'abbreviation' => 'JIN',
            'league_id' => $leagueId,
        ]);

        Team::create([
            'name' => 'Lightnings',
            'abbreviation' => 'LHT',
            'league_id' => $leagueId,
        ]);

        Team::create([
            'name' => 'Hex',
            'abbreviation' => 'Hex',
            'league_id' => $leagueId,
        ]);

        Team::create([
            'name' => 'Haiti Underwear',
            'abbreviation' => 'HTU',
            'league_id' => $leagueId,
        ]);

        Team::create([
            'name' => 'Chobios',
            'abbreviation' => 'CHO',
            'league_id' => $leagueId,
        ]);
    }
}
