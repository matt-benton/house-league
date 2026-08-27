<?php

use App\Models\League;
use App\Models\User;
use Livewire\Livewire;

test('it can create a league', function () {
    $this->actingAs(User::factory()->admin()->make());

    expect(League::count())->toBe(0);

    Livewire::test('pages::league.create')
        ->set('name', 'Test League')
        ->call('save');

    expect(League::count())->toBe(1);

    expect(League::value('name'))->toBe('Test League');
});

test('it can show a league', function () {
    $league = League::factory()->make();

    Livewire::test('pages::league.show', ['league' => $league])
        ->assertOk()
        ->assertSet('league', $league);
});
