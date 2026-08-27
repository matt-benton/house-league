<?php

use Illuminate\Support\Facades\Route;

Route::livewire('/', 'pages::dashboard')->name('dashboard');
Route::livewire('/teams', 'pages::team.index')->name('teams.index');
Route::livewire('/players', 'pages::player.index')->name('players.index');
Route::livewire('/games', 'pages::game.index')->name('games.index');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::livewire('/teams/create', 'pages::team.create')->name('teams.create');
    Route::livewire('/teams/{team}/edit', 'pages::team.edit')->name('teams.edit')->withTrashed();

    Route::livewire('/players/create', 'pages::player.create')->name('players.create');
    Route::livewire('/players/{player}/edit', 'pages::player.edit')->name('players.edit')->withTrashed();

    Route::livewire('/posts/create', 'pages::post.create')->name('posts.create');
    Route::livewire('/posts/{post}/edit', 'pages::post.edit')->name('posts.edit');

    Route::livewire('/users', 'pages::user.index')->name('users.index');

    Route::livewire('/games/create', 'pages::game.create')->name('games.create');
    Route::livewire('/games/{game}/edit', 'pages::game.edit')->name('games.edit');

    Route::livewire('/leagues/create', 'pages::league.create')->name('leagues.create');
});

Route::livewire('/teams/{team}', 'pages::team.show')->name('teams.show')->withTrashed();
Route::livewire('/players/{player}', 'pages::player.show')->name('players.show')->withTrashed();
Route::livewire('/posts/{post}', 'pages::post.show')->name('posts.show');
Route::livewire('/games/{game}', 'pages::game.show')->name('games.show');
Route::livewire('/leagues/{league}', 'pages::league.show')->name('leagues.show');

require __DIR__.'/settings.php';
