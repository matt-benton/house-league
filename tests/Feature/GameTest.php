<?php

use App\Models\Game;
use App\Models\GameEvent;
use App\Models\Player;
use App\Models\Team;
use App\Models\User;
use Livewire\Livewire;

test('it can create a game', function () {
    $home = Team::factory()->create();
    $away = Team::factory()->create();

    expect(Game::count())->toBe(0);

    $this->actingAs(User::factory()->admin()->make());

    Livewire::test('pages::game.create')
        ->set('home_team_id', $home->id)
        ->set('away_team_id', $away->id)
        ->call('save');

    expect(Game::count())->toBe(1);
});

test('a player can score a goal', function () {
    $this->actingAs(User::factory()->admin()->make());

    $home = Team::factory()
        ->has(Player::factory(), 'roster')
        ->create();
    $away = Team::factory()->create();

    $game = Game::factory()
        ->for($home, 'homeTeam')
        ->for($away, 'awayTeam')
        ->create();

    $player = $home->roster[0];

    expect(GameEvent::count())->toBe(0);

    Livewire::test('pages::game.edit', ['game' => $game])
        ->call('scoreGoal', $player->id)
        ->assertSet('homeScore', 1)
        ->assertSet('awayScore', 0);

    expect(GameEvent::count())->toBe(1);

    $goal = GameEvent::first();

    expect($goal->player_id)->toBe($player->id);
    expect($goal->team_id)->toBe($home->id);
    expect($goal->game_id)->toBe($game->id);
    expect($goal->type)->toBe('goal');
});

test('a player can receive a yellow card', function () {
    $this->actingAs(User::factory()->admin()->make());

    $home = Team::factory()
        ->has(Player::factory(), 'roster')
        ->create();
    $away = Team::factory()->create();

    $game = Game::factory()
        ->for($home, 'homeTeam')
        ->for($away, 'awayTeam')
        ->create();

    $player = $home->roster[0];

    expect(GameEvent::count())->toBe(0);

    Livewire::test('pages::game.edit', ['game' => $game])
        ->call('giveYellowCard', $player->id);

    expect(GameEvent::count())->toBe(1);

    $card = GameEvent::first();

    expect($card->player_id)->toBe($player->id);
    expect($card->team_id)->toBe($home->id);
    expect($card->game_id)->toBe($game->id);
    expect($card->type)->toBe('yellow card');
});
