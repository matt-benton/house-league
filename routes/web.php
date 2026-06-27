<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');
Route::livewire('/teams', 'pages::team.index')->name('teams.index');
Route::livewire('/teams/{team}', 'pages::team.show')->name('teams.show');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
    Route::livewire('/teams/create', 'pages::team.create')->name('teams.create');
});

require __DIR__.'/settings.php';
