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
        $goal->team_id = $player->team_id;
        $goal->game_id = $this->game->id;
        $goal->save();

        Flux::toast(
            variant: 'success',
            text: "Goooooaallll!!!! {$player->name} has scored!",
        );
    }

    public function giveYellowCard($playerId)
    {
        $player = Player::find($playerId);

        $card = new GameEvent;
        $card->type = GameEventType::YellowCard;
        $card->player_id = $player->id;
        $card->team_id = $player->team_id;
        $card->game_id = $this->game->id;
        $card->save();

        Flux::toast(
            variant: 'warning',
            text: "{$player->name} has been given a yellow card",
        );
    }

    public function giveRedCard($playerId)
    {
        $player = Player::find($playerId);

        $card = new GameEvent;
        $card->type = GameEventType::RedCard;
        $card->player_id = $player->id;
        $card->team_id = $player->team_id;
        $card->game_id = $this->game->id;
        $card->save();

        Flux::toast(
            variant: 'danger',
            text: "{$player->name} has been given a red card",
        );
    }

    public function recordSave($playerId)
    {
        $player = Player::find($playerId);

        $save = new GameEvent;
        $save->type = GameEventType::Save;
        $save->player_id = $player->id;
        $save->team_id = $player->team_id;
        $save->game_id = $this->game->id;
        $save->save();

        Flux::toast(
            variant: 'success',
            text: "Save by {$player->name}!",
        );
    }

    public function endGame()
    {
        $this->game->is_complete = 1;
        $this->game->save();

        $winningTeam = null;

        if ($this->homeScore > $this->awayScore) {
            $winningTeam = $this->game->homeTeam;
        } elseif ($this->awayScore > $this->homeScore) {
            $winningTeam = $this->game->awayTeam;
        }

        Flux::toast(
            variant: 'success',
            text: $winningTeam
                ? "{$winningTeam->name} win! Final score: {$this->homeScore} ({$this->game->homeTeam->abbreviation}) - {$this->awayScore} ({$this->game->awayTeam->abbreviation})"
                : "Tie game! Final score: {$this->homeScore} ({$this->game->homeTeam->abbreviation}) - {$this->awayScore} ({$this->game->awayTeam->abbreviation})",
            duration: 10000,
        );

        $this->redirect('/', navigate: true);
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
