<?php

use App\Models\Game;
use App\Models\Player;
use App\Models\Team;

test('it simulates a complete game and fills short rosters', function () {
    $shortRosterTeam = Team::factory()
        ->has(Player::factory()->count(3), 'roster')
        ->create();
    $fullRosterTeam = Team::factory()
        ->has(Player::factory()->count(12), 'roster')
        ->create();
    $existingPlayerIds = Player::query()->pluck('id');

    $this->artisan('games:simulate')
        ->expectsOutputToContain('Simulated game #')
        ->assertSuccessful();

    $game = Game::query()->sole();

    expect([$game->home_team_id, $game->away_team_id])
        ->toContain($shortRosterTeam->id, $fullRosterTeam->id)
        ->and($game->home_team_id)->not->toBe($game->away_team_id)
        ->and($game->league_id)->toBe($game->homeTeam->league_id)
        ->and($game->is_complete)->toBeTruthy()
        ->and($shortRosterTeam->roster()->count())->toBe(11)
        ->and($fullRosterTeam->roster()->count())->toBe(12)
        ->and(Player::query()->whereKey($existingPlayerIds)->count())->toBe(15);

    foreach ([$shortRosterTeam, $fullRosterTeam] as $team) {
        $score = $game->goals()->where('team_id', $team->id)->count();

        expect($score)
            ->toBeGreaterThanOrEqual(0)
            ->toBeLessThanOrEqual(8);
    }

    $homeScore = $game->goals()->where('team_id', $game->home_team_id)->count();
    $awayScore = $game->goals()->where('team_id', $game->away_team_id)->count();
    $homeTeam = $game->homeTeam->fresh();
    $awayTeam = $game->awayTeam->fresh();

    if ($homeScore > $awayScore) {
        expect([$homeTeam->wins, $homeTeam->losses, $homeTeam->draws])->toBe([1, 0, 0])
            ->and([$awayTeam->wins, $awayTeam->losses, $awayTeam->draws])->toBe([0, 1, 0]);
    } elseif ($awayScore > $homeScore) {
        expect([$homeTeam->wins, $homeTeam->losses, $homeTeam->draws])->toBe([0, 1, 0])
            ->and([$awayTeam->wins, $awayTeam->losses, $awayTeam->draws])->toBe([1, 0, 0]);
    } else {
        expect([$homeTeam->wins, $homeTeam->losses, $homeTeam->draws])->toBe([0, 0, 1])
            ->and([$awayTeam->wins, $awayTeam->losses, $awayTeam->draws])->toBe([0, 0, 1]);
    }

    foreach ($game->events as $event) {
        expect($event->type)->toBe('goal')
            ->and([$game->home_team_id, $game->away_team_id])->toContain($event->team_id)
            ->and($event->player->team_id)->toBe($event->team_id);
    }
});

test('it simulates the requested number of games', function () {
    Team::factory()->count(2)->create();

    $this->artisan('games:simulate', ['count' => 3])->assertSuccessful();

    expect(Game::query()->count())->toBe(3)
        ->and(Game::query()->where('is_complete', true)->count())->toBe(3)
        ->and(Player::query()->count())->toBe(22);
});

test('it requires at least two teams', function () {
    Team::factory()->create();

    $this->artisan('games:simulate')
        ->expectsOutputToContain('At least two teams are required')
        ->assertFailed();

    expect(Game::query()->count())->toBe(0);
});

test('it requires a positive integer game count', function (string $count) {
    Team::factory()->count(2)->create();

    $this->artisan('games:simulate', ['count' => $count])
        ->expectsOutputToContain('The game count must be a positive integer')
        ->assertFailed();

    expect(Game::query()->count())->toBe(0);
})->with(['0', '-1', '1.5', 'invalid']);
