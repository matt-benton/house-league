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

test('it can create a post', function () {
    expect(Post::count())->toBe(0);

    $user = User::factory()->admin()->create();

    $this->actingAs($user);

    Livewire::test('pages::post.create')
        ->set('title', 'New season for House League')
        ->set('text', '<p>This is the inaugural season for House League</p>')
        ->call('publish');

    expect(Post::count())->toBe(1);

    $post = Post::first();

    expect($post->title)->toBe('New season for House League');
    expect($post->text)->toBe('<p>This is the inaugural season for House League</p>');
    expect($post->user_id)->toBe($user->id);
});

test('it can show a post', function () {
    $author = User::factory()->admin()->create();

    $post = Post::factory()
        ->for($author, 'author')
        ->state([
            'title' => 'Test post',
            'text' => 'This is a test post',
        ])
        ->create();

    Livewire::test('pages::post.show', ['post' => $post])
        ->assertSee('Test post')
        ->assertSee('This is a test post');
});

test('it can delete a post', function () {
    $post = Post::factory()
        ->for(User::factory()->admin(), 'author')
        ->create();

    $this->actingAs(User::factory()->admin()->make());

    Livewire::test('pages::post.edit', ['post' => $post])
        ->call('delete');

    expect(Post::count())->toBe(0);
});

test('it can edit a post', function () {
    $post = Post::factory()
        ->for(User::factory()->admin(), 'author')
        ->state([
            'title' => 'Test Title for Edit',
            'text' => '<p>This is going to be edited</p>',
        ])
        ->create();

    $this->actingAs(User::factory()->admin()->make());

    Livewire::test('pages::post.edit', ['post' => $post])
        ->assertSet('title', 'Test Title for Edit')
        ->assertSet('text', '<p>This is going to be edited</p>')
        ->set('title', 'Title has been edited')
        ->set('text', '<h1>The text has been edited</h1>')
        ->call('save');

    $post->refresh();

    expect($post->title)->toBe('Title has been edited');
    expect($post->text)->toBe('<h1>The text has been edited</h1>');
});
