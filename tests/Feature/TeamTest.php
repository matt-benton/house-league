<?php

use App\Models\Team;
use App\Models\User;
use Livewire\Livewire;

beforeEach(function () {});

test('list of teams is displayed', function () {
    Team::factory()->count(3)->create();

    Livewire::test('pages::team.index')
        ->assertCount('teams', 3);
});

test('can create a team', function () {
    expect(Team::count())->toBe(0);
    $user = User::factory()
        ->admin()
        ->create();

    $this->actingAs($user);

    Livewire::test('pages::team.create')
        ->set('abbreviation', 'TST')
        ->set('name', 'Test')
        ->call('save');

    expect(Team::count())->toBe(1);

    $team = Team::first();

    expect($team->abbreviation)->toBe('TST');
    expect($team->name)->toBe('Test');
});
