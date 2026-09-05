<?php

use App\Enums\GameEventType;
use App\Models\Game;
use Flux\Flux;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component
{
    public Game $game;

    public function mount(Game $game): void
    {
        $this->authorize('view', $game);

        $game->load(['homeTeam', 'awayTeam', 'events.player', 'events.team', 'events.secondaryEvent']);
        $game->setRelation('events', $game->events->sortBy('id')->values());

        $this->game = $game;
    }

    #[Computed]
    public function homeScore(): int
    {
        return $this->game->events
            ->where('type', GameEventType::Goal->value)
            ->where('team_id', $this->game->home_team_id)
            ->count();
    }

    #[Computed]
    public function awayScore(): int
    {
        return $this->game->events
            ->where('type', GameEventType::Goal->value)
            ->where('team_id', $this->game->away_team_id)
            ->count();
    }

    public function render(): View
    {
        return $this->view()
            ->title($this->game->homeTeam->abbreviation.' vs '.$this->game->awayTeam->abbreviation);
    }

    public function delete()
    {
        $this->authorize('delete', $this->game);

        $this->updateTeamRecords();

        $this->game->delete();

        Flux::toast(
            variant: 'success',
            text: 'Match has been deleted',
        );

        $this->redirect('/games', navigate: true);
    }

    private function updateTeamRecords()
    {
        if ($this->homeScore > $this->awayScore) {
            $winningTeam = $this->game->homeTeam;
            $winningTeam->wins--;

            if ($winningTeam->wins >= 0) {
                $winningTeam->save();
            }

            $losingTeam = $this->game->awayTeam;
            $losingTeam->losses--;

            if ($losingTeam->losses >= 0) {
                $losingTeam->save();
            }
        } elseif ($this->awayScore > $this->homeScore) {
            $winningTeam = $this->game->awayTeam;
            $winningTeam->wins--;
            if ($winningTeam->wins >= 0) {
                $winningTeam->save();
            }

            $losingTeam = $this->game->homeTeam;
            $losingTeam->losses--;
            if ($losingTeam->losses >= 0) {
                $losingTeam->save();
            }
        } else {
            $homeTeam = $this->game->homeTeam;
            $homeTeam->draws--;

            if ($homeTeam->draws >= 0) {
                $homeTeam->save();
            }

            $awayTeam = $this->game->awayTeam;
            $awayTeam->draws--;

            if ($awayTeam->draws >= 0) {
                $awayTeam->save();
            }
        }
    }
};
