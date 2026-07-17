<?php

use App\Models\Game;
use App\Models\Team;
use App\Models\User;
use Livewire\Livewire;

test('it can create a game', function () {
    $home = Team::factory()->create();
    $away = Team::factory()->create();

    expect(Game::count())->toBe(0);

    $this->actingAs(User::factory()->admin()->make());

    Livewire::test('pages::game.create')
        ->set('home_team_id', $home->id)
        ->set('away_team_id', $away->id)
        ->call('save');

    expect(Game::count())->toBe(1);
});
