<?php

use App\Models\Post;
use App\Models\User;
use Livewire\Livewire;

test('it can see a list of posts', function () {
    Post::factory()
        ->state(['title' => 'This is a new post'])
        ->for(User::factory(), 'author')
        ->create();

    Livewire::test('pages::dashboard')
        ->assertSee('This is a new post');
});
