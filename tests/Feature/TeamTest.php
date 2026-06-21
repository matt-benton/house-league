<?php

use App\Models\Team;
use Livewire\Livewire;

beforeEach(function () {
    Team::factory()->count(3)->create();
});

test('list of teams is displayed', function () {
    Livewire::test('pages::team.index')
        ->assertCount('teams', 3);
});
