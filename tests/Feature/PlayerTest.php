<?php

use App\Enums\Position;
use App\Models\Player;
use App\Models\Team;
use App\Models\User;
use Livewire\Livewire;

test('it can display a list of players', function () {
    Player::factory()->count(3)->create();

    Livewire::test('pages::player.index')
        ->assertCount('players', 3);
});

test('it can create a player', function () {
    $this->actingAs(User::factory()->admin()->make());

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
    expect($player->position->value)->toBe('defender');
    expect($player->team_id)->toBe($team->id);
});

test('it can create a player with no team', function () {
    $this->actingAs(User::factory()->admin()->make());

    Livewire::test('pages::player.create')
        ->set('name', 'John Doe')
        ->set('number', '99')
        ->set('position', 'defender')
        ->set('teamId', '')
        ->call('save');

    $player = Player::first();

    expect($player->team_id)->toBeNull();
});

test('it can show player info', function () {
    $player = Player::factory()
        ->for(Team::factory())
        ->create();

    Livewire::test('pages::player.show', ['player' => $player])
        ->assertSeeText($player->name);
});

test('it can delete a player', function () {
    $player = Player::factory()
        ->for(Team::factory())
        ->create();

    $this->actingAs(User::factory()->admin()->make());

    Livewire::test('pages::player.edit', ['player' => $player])
        ->call('delete');

    $player->refresh();

    expect($player->deleted_at)->toBeTruthy();
});

test('it can restore a deleted player', function () {
    $this->actingAs(User::factory()->admin()->make());

    $player = Player::factory()
        ->state(['deleted_at' => now()])
        ->create();

    expect($player->deleted_at)->toBeTruthy();

    Livewire::test('pages::player.edit', ['player' => $player])
        ->call('restore');

    $player->refresh();

    expect($player->deleted_at)->toBeNull();
});

test('it can edit a player', function () {
    $teams = Team::factory()->count(2)->create();
    $player = Player::factory()
        ->state([
            'name' => 'Test Player',
            'number' => '28',
            'position' => 'forward',
        ])
        ->for($teams[1])
        ->create();

    $this->actingAs(User::factory()->admin()->make());

    Livewire::test('pages::player.edit', ['player' => $player])
        ->assertSet('name', 'Test Player')
        ->assertSet('number', '28')
        ->assertSet('position', 'forward')
        ->assertSet('teamId', $teams[1]->id)
        ->set('name', 'Edited')
        ->set('number', '11')
        ->set('position', 'goalkeeper')
        ->set('teamId', $teams[0]->id)
        ->call('save');

    $player->refresh();

    expect($player->name)->toBe('Edited');
    expect($player->number)->toBe(11);
    expect($player->position)->toBe(Position::Goalkeeper);
    expect($player->team_id)->toBe($teams[0]->id);
});

test('it can clear a player team', function () {
    $player = Player::factory()
        ->for(Team::factory())
        ->create();

    $this->actingAs(User::factory()->admin()->make());

    Livewire::test('pages::player.edit', ['player' => $player])
        ->set('teamId', '')
        ->call('save');

    $player->refresh();

    expect($player->team_id)->toBeNull();
});
