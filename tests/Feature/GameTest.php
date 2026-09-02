<?php

use App\Enums\GameEventType;
use App\Models\Game;
use App\Models\GameEvent;
use App\Models\League;
use App\Models\Player;
use App\Models\Team;
use App\Models\User;
use Livewire\Livewire;

test('it displays a list of games', function () {
    $teams = Team::factory()->count(4)->create();
    $league = League::factory()->create();
    session()->put('league_id', $league->id);

    Game::factory()
        ->for($league)
        ->for($teams[0], 'homeTeam')
        ->for($teams[1], 'awayTeam')
        ->create();

    Game::factory()
        ->for($league)
        ->for($teams[2], 'homeTeam')
        ->for($teams[3], 'awayTeam')
        ->create();

    $this->get(route('games.index'))
        ->assertOk()
        ->assertSeeText($teams->pluck('abbreviation')->all());

    Livewire::test('pages::game.index')
        ->assertCount('games', 2)
        ->assertSeeText($teams->pluck('abbreviation')->all());
});

test('it displays a game with its teams and score', function () {
    $league = League::factory()->create();
    $home = Team::factory()
        ->for($league)
        ->has(Player::factory(), 'roster')
        ->create();
    $away = Team::factory()
        ->for($league)
        ->has(Player::factory(), 'roster')
        ->create();
    $game = Game::factory()
        ->for($league)
        ->for($home, 'homeTeam')
        ->for($away, 'awayTeam')
        ->create();

    GameEvent::factory()->count(2)->create([
        'type' => 'goal',
        'game_id' => $game->id,
        'player_id' => $home->roster->first()->id,
        'team_id' => $home->id,
    ]);
    GameEvent::factory()->create([
        'type' => 'goal',
        'game_id' => $game->id,
        'player_id' => $away->roster->first()->id,
        'team_id' => $away->id,
    ]);

    $this->get(route('games.show', $game))
        ->assertOk()
        ->assertSeeText([$home->name, $away->name])
        ->assertSeeTextInOrder(['2', '-', '1']);
});

test('it can delete a game with events', function () {
    $this->actingAs(User::factory()->admin()->make());

    $league = League::factory()->create();

    $home = Team::factory()
        ->for($league)
        ->has(Player::factory(), 'roster')
        ->state(['wins' => 1])
        ->create();
    $away = Team::factory()
        ->for($league)
        ->has(Player::factory(), 'roster')
        ->state(['losses' => 1])
        ->create();

    $game = Game::factory()
        ->for($league)
        ->for($home, 'homeTeam')
        ->for($away, 'awayTeam')
        ->has(GameEvent::factory()
            ->state(['type' => GameEventType::Goal])
            ->for($home)
            ->for($home->roster[0]), 'events')
        ->state(['is_complete' => 1])
        ->create();

    Livewire::test('pages::game.show', ['game' => $game])
        ->call('delete');

    expect(GameEvent::where('game_id', $game->id)->count())->toBe(0);
    expect($game->fresh())->toBeNull();
    expect($home->fresh()->wins)->toBe(0);
    expect($away->fresh()->losses)->toBe(0);
});

test('it can create a game', function () {
    $league = League::factory()->create();

    $home = Team::factory()
        ->for($league)
        ->has(Player::factory(), 'roster')
        ->create();
    $away = Team::factory()
        ->for($league)
        ->has(Player::factory(), 'roster')
        ->create();

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
    $league = League::factory()->create();

    $home = Team::factory()
        ->for($league)
        ->has(Player::factory(), 'roster')
        ->create();
    $away = Team::factory()->create();

    $game = Game::factory()
        ->for($league)
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
    $league = League::factory()->create();

    $home = Team::factory()
        ->for($league)
        ->has(Player::factory(), 'roster')
        ->create();
    $away = Team::factory()->create();

    $game = Game::factory()
        ->for($league)
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

test('a player can receive a red card', function () {
    $this->actingAs(User::factory()->admin()->make());
    $league = League::factory()->create();

    $home = Team::factory()
        ->for($league)
        ->has(Player::factory(), 'roster')
        ->create();
    $away = Team::factory()->create();

    $game = Game::factory()
        ->for($league)
        ->for($home, 'homeTeam')
        ->for($away, 'awayTeam')
        ->create();

    $player = $home->roster[0];

    expect(GameEvent::count())->toBe(0);

    Livewire::test('pages::game.edit', ['game' => $game])
        ->call('giveRedCard', $player->id);

    expect(GameEvent::count())->toBe(1);

    $card = GameEvent::first();

    expect($card->player_id)->toBe($player->id);
    expect($card->team_id)->toBe($home->id);
    expect($card->game_id)->toBe($game->id);
    expect($card->type)->toBe('red card');
});

test('a player can make a save', function () {
    $this->actingAs(User::factory()->admin()->make());
    $league = League::factory()->create();

    $home = Team::factory()
        ->for($league)
        ->has(Player::factory(), 'roster')
        ->create();
    $away = Team::factory()
        ->for($league)
        ->create();

    $game = Game::factory()
        ->for($league)
        ->for($home, 'homeTeam')
        ->for($away, 'awayTeam')
        ->create();

    $player = $home->roster[0];

    expect(GameEvent::count())->toBe(0);

    Livewire::test('pages::game.edit', ['game' => $game])
        ->call('recordSave', $player->id);

    expect(GameEvent::count())->toBe(1);

    $save = GameEvent::first();

    expect($save->player_id)->toBe($player->id);
    expect($save->team_id)->toBe($home->id);
    expect($save->game_id)->toBe($game->id);
    expect($save->type)->toBe('save');
});

test('it can end a match', function () {
    $this->actingAs(User::factory()->admin()->make());
    $league = League::factory()->create();

    $home = Team::factory()->for($league)->create();
    $away = Team::factory()->for($league)->create();

    $game = Game::factory()
        ->for($league)
        ->for($home, 'homeTeam')
        ->for($away, 'awayTeam')
        ->create();

    Livewire::test('pages::game.edit', ['game' => $game])
        ->call('endGame');

    expect($game->fresh()->is_complete)->toBeTruthy();
});

test('a team can win a match', function () {
    $this->actingAs(User::factory()->admin()->make());
    $league = League::factory()->create();

    $home = Team::factory()->for($league)->create();
    $away = Team::factory()->for($league)->create();

    $player = Player::factory()
        ->for($home)
        ->create();

    $game = Game::factory()
        ->for($league)
        ->for($home, 'homeTeam')
        ->for($away, 'awayTeam')
        ->create();

    Livewire::test('pages::game.edit', ['game' => $game])
        ->call('scoreGoal', $player->id)
        ->call('endGame');

    expect($home->fresh()->wins)->toBe(1);
    expect($home->fresh()->losses)->toBe(0);
    expect($home->fresh()->draws)->toBe(0);

    expect($away->fresh()->wins)->toBe(0);
    expect($away->fresh()->losses)->toBe(1);
    expect($away->fresh()->draws)->toBe(0);
});

test('teams can draw a match', function () {
    $this->actingAs(User::factory()->admin()->make());
    $league = League::factory()->create();

    $home = Team::factory()->for($league)->create();
    $away = Team::factory()->for($league)->create();

    $homePlayer = Player::factory()
        ->for($home)
        ->create();

    $awayPlayer = Player::factory()
        ->for($away)
        ->create();

    $game = Game::factory()
        ->for($league)
        ->for($home, 'homeTeam')
        ->for($away, 'awayTeam')
        ->create();

    Livewire::test('pages::game.edit', ['game' => $game])
        ->call('scoreGoal', $homePlayer->id)
        ->call('scoreGoal', $awayPlayer->id)
        ->call('endGame');

    expect($home->fresh()->wins)->toBe(0);
    expect($home->fresh()->losses)->toBe(0);
    expect($home->fresh()->draws)->toBe(1);

    expect($away->fresh()->wins)->toBe(0);
    expect($away->fresh()->losses)->toBe(0);
    expect($away->fresh()->draws)->toBe(1);
});
