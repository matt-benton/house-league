<?php

use App\Enums\GameEventType;
use App\Models\Game;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component
{
    public Game $game;

    public function mount(Game $game): void
    {
        $this->authorize('view', $game);

        $game->load(['homeTeam', 'awayTeam', 'events.player', 'events.team']);
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
};
