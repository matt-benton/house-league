<?php

use App\Models\User;
use Livewire\Livewire;

test('it can display a list of users', function () {
    User::factory()->count(3)->create();

    $this->actingAs(User::factory()->admin()->create());

    Livewire::test('pages::user.index')
        ->assertCount('users', 4);
});
