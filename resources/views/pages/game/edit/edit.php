<?php

use App\Enums\GameEventType;
use App\Models\Game;
use App\Models\GameEvent;
use App\Models\Player;
use Flux\Flux;
use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component
{
    public Game $game;

    public array $gameEventTypes;

    public function mount(Game $game)
    {
        $this->authorize('update', $game);

        $this->game = $game;

        $this->gameEventTypes = GameEventType::cases();
    }

    public function render()
    {
        return $this->view()
            ->title($this->game->homeTeam->abbreviation.' vs '.$this->game->awayTeam->abbreviation);
    }

    public function scoreGoal($playerId)
    {
        $player = Player::find($playerId);

        $goal = new GameEvent;
        $goal->type = GameEventType::Goal;
        $goal->player_id = $player->id;
        $goal->team_id = $player->team->id;
        $goal->game_id = $this->game->id;
        $goal->save();

        Flux::toast(
            variant: 'success',
            text: "Goooooaallll!!!! {$player->name} has scored!",
        );
    }

    #[Computed]
    public function allPlayers()
    {
        return $this->game->homeTeam->roster->concat($this->game->awayTeam->roster);
    }

    #[Computed]
    public function homeScore()
    {
        return $this->game->goals()
            ->where('team_id', $this->game->home_team_id)
            ->count();
    }

    #[Computed]
    public function awayScore()
    {
        return $this->game->goals()
            ->where('team_id', $this->game->away_team_id)
            ->count();
    }
};
