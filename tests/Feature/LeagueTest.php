<?php

use App\Models\League;
use App\Models\User;
use Livewire\Livewire;

test('it can create a league', function () {
    $this->actingAs(User::factory()->admin()->make());

    expect(League::count())->toBe(1); // House League also exists so this will be the second league

    Livewire::test('pages::league.create')
        ->set('name', 'Test League')
        ->call('save');

    expect(League::count())->toBe(2);

    expect(League::orderByDesc('id')->value('name'))->toBe('Test League');
});

test('it can show a league', function () {
    $league = League::factory()->make();

    Livewire::test('pages::league.show', ['league' => $league])
        ->assertOk()
        ->assertSet('league', $league);
});

test('it can soft delete a league', function () {
    $this->actingAs(User::factory()->admin()->make());
    $league = League::factory()->create();

    Livewire::test('pages::league.edit', ['league' => $league])
        ->call('delete');

    $league->refresh();

    expect($league->deleted_at)->toBeTruthy();
});

test('it can restore a soft deleted league', function () {
    $league = League::factory()
        ->state(['deleted_at' => now()])
        ->create();

    $this->actingAs(User::factory()->admin()->make());

    Livewire::test('pages::league.edit', ['league' => $league])
        ->call('restore');

    $league->refresh();

    expect($league->deleted_at)->toBeNull();
});

test('it can rename a league', function () {
    $league = League::factory()
        ->state(['name' => 'My League'])
        ->create();

    $this->actingAs(User::factory()->admin()->make());

    Livewire::test('pages::league.edit', ['league' => $league])
        ->assertSet('name', 'My League')
        ->set('name', 'Renamed League')
        ->call('save');

    $league->refresh();

    expect($league->name)->toBe('Renamed League');
});
