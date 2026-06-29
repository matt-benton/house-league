<?php

use App\Models\Player;
use App\Models\Team;
use Livewire\Livewire;

test('it can display a list of players', function () {
    Player::factory()->count(3)->create();

    Livewire::test('pages::player.index')
        ->assertCount('players', 3);
});

test('it can create a player', function () {
    expect(Player::count())->toBe(0);

    $team = Team::factory()->create();

    Livewire::test('pages::player.create')
        ->set('name', 'John Doe')
        ->set('number', '99')
        ->set('position', 'defender')
        ->set('teamId', $team->id)
        ->call('save');

    expect(Player::count())->toBe(1);

    $player = Player::first();

    expect($player->name)->toBe('John Doe');
    expect($player->number)->toBe(99);
    expect($player->position)->toBe('defender');
    expect($player->team_id)->toBe($team->id);
});

test('it can create a player with no team', function () {
    Livewire::test('pages::player.create')
        ->set('name', 'John Doe')
        ->set('number', '99')
        ->set('position', 'defender')
        ->call('save');

    $player = Player::first();

    expect($player->team_id)->toBeNull();
});
