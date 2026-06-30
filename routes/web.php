<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');
Route::livewire('/teams', 'pages::team.index')->name('teams.index');
Route::livewire('/players', 'pages::player.index')->name('players.index');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
    Route::livewire('/teams/create', 'pages::team.create')->name('teams.create');
    Route::livewire('/teams/{team}/edit', 'pages::team.edit')->name('teams.edit')->withTrashed();

    Route::livewire('/players/create', 'pages::player.create')->name('players.create');
});

Route::livewire('/teams/{team}', 'pages::team.show')->name('teams.show')->withTrashed();
Route::livewire('/players/{player}', 'pages::player.show')->name('players.show')->withTrashed();

require __DIR__.'/settings.php';
