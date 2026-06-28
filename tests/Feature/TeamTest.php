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

test('it renders the show page', function () {
    $team = Team::factory()->make();

    Livewire::test('pages::team.show', ['team' => $team])
        ->assertSeeText($team->abbreviation)
        ->assertSeeText($team->name);
});

test('it can edit a team', function () {
    $team = Team::factory()
        ->state([
            'abbreviation' => 'TST',
            'name' => 'Test Team',
        ])
        ->create();

    $this->actingAs(User::factory()->admin()->make());

    Livewire::test('pages::team.edit', ['team' => $team])
        ->assertSet('abbreviation', 'TST')
        ->assertSet('name', 'Test Team')
        ->set('abbreviation', '123')
        ->set('name', 'Changed Team')
        ->call('save');

    $team->refresh();

    expect($team->abbreviation)->toBe('123');
    expect($team->name)->toBe('Changed Team');
});
