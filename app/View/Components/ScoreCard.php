<?php

namespace App\View\Components;

use App\Models\Game;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ScoreCard extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public Game $match)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.score-card', [
            'homeScore' => $this->match->goals->filter(
                fn ($goal) => $goal->team_id === $this->match->home_team_id
            )->count(),
            'awayScore' => $this->match->goals->filter(
                fn ($goal) => $goal->team_id === $this->match->away_team_id
            )->count(),
        ]);
    }
}
