<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');
Route::livewire('/teams', 'pages::team.index')->name('teams.index');
Route::livewire('/players', 'pages::player.index')->name('players.index');
Route::livewire('/dashboard', 'pages::dashboard')->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::livewire('/teams/create', 'pages::team.create')->name('teams.create');
    Route::livewire('/teams/{team}/edit', 'pages::team.edit')->name('teams.edit')->withTrashed();

    Route::livewire('/players/create', 'pages::player.create')->name('players.create');
    Route::livewire('/players/{player}/edit', 'pages::player.edit')->name('players.edit')->withTrashed();

    Route::livewire('/posts/create', 'pages::post.create')->name('posts.create');
});

Route::livewire('/teams/{team}', 'pages::team.show')->name('teams.show')->withTrashed();
Route::livewire('/players/{player}', 'pages::player.show')->name('players.show')->withTrashed();
Route::livewire('/posts/{post}', 'pages::post.show')->name('posts.show');

require __DIR__.'/settings.php';
