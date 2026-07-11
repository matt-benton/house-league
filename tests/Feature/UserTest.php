<?php

use App\Models\User;
use Livewire\Livewire;

test('it can display a list of users', function () {
    User::factory()->count(3)->create();

    $this->actingAs(User::factory()->admin()->create());

    Livewire::test('pages::user.index')
        ->assertCount('users', 4);
});

test('it can set a user as admin', function () {
    $user = User::factory()->create();

    Livewire::test('user.editable-row', ['user' => $user])
        ->assertSet('isAdmin', 0)
        ->set('isAdmin', 1);

    expect($user->fresh()->is_admin)->toBe(1);
});
