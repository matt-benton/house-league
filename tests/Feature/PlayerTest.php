<?php

use App\Models\Player;
use Livewire\Livewire;

test('it can display a list of players', function () {
    Player::factory()->count(3)->create();

    Livewire::test('pages::player.index')
        ->assertCount('players', 3);
});
