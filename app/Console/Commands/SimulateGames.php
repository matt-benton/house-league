<?php

namespace App\Console\Commands;

use App\Enums\GameEventType;
use App\Models\Game;
use App\Models\GameEvent;
use App\Models\Player;
use App\Models\Scopes\OrderByNameScope;
use App\Models\Team;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

#[Signature('games:simulate {count=1 : The number of games to simulate}')]
#[Description('Simulate completed games between existing teams')]
class SimulateGames extends Command
{
    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $count = filter_var(
            $this->argument('count'),
            FILTER_VALIDATE_INT,
            ['options' => ['min_range' => 1]],
        );

        if ($count === false) {
            $this->error('The game count must be a positive integer.');

            return self::FAILURE;
        }

        if (Team::query()->count() < 2) {
            $this->error('At least two teams are required to simulate a game.');

            return self::FAILURE;
        }

        for ($gameNumber = 0; $gameNumber < $count; $gameNumber++) {
            $summary = DB::transaction(function (): string {
                $teams = Team::query()
                    ->withoutGlobalScope(OrderByNameScope::class)
                    ->inRandomOrder()
                    ->limit(2)
                    ->get();

                foreach ($teams as $team) {
                    $playersNeeded = max(0, 11 - $team->roster()->count());

                    if ($playersNeeded > 0) {
                        Player::factory()
                            ->count($playersNeeded)
                            ->for($team)
                            ->create();
                    }
                }

                $homeTeam = $teams->first();
                $awayTeam = $teams->last();
                $game = Game::create([
                    'home_team_id' => $homeTeam->id,
                    'away_team_id' => $awayTeam->id,
                ]);
                $scores = [
                    $homeTeam->id => random_int(0, 8),
                    $awayTeam->id => random_int(0, 8),
                ];

                foreach ($teams as $team) {
                    $roster = $team->roster()->get();

                    for ($goalNumber = 0; $goalNumber < $scores[$team->id]; $goalNumber++) {
                        $player = $roster->random();
                        $goal = new GameEvent;
                        $goal->type = GameEventType::Goal;
                        $goal->player()->associate($player);
                        $goal->team()->associate($team);

                        $game->events()->save($goal);
                    }
                }

                $game->is_complete = true;
                $game->save();

                return "Simulated game #{$game->id}: {$homeTeam->name} {$scores[$homeTeam->id]} - {$scores[$awayTeam->id]} {$awayTeam->name}";
            });

            $this->info($summary);
        }

        return self::SUCCESS;
    }
}
