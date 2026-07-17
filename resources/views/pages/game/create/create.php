<?php

use App\Models\Game;
use App\Models\Team;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

new #[Title('New Match')] class extends Component
{
    #[Validate('required|exists:teams,id', as: 'home team')]
    public $home_team_id = '';

    #[Validate('required|exists:teams,id|different:home_team_id', as: 'away team')]
    public $away_team_id = '';

    public $teams;

    public function mount()
    {
        $this->authorize('create', Game::class);

        $this->teams = Team::all();
    }

    public function save()
    {
        $validated = $this->validate();

        $game = Game::create([
            'home_team_id' => $validated['home_team_id'],
            'away_team_id' => $validated['away_team_id'],
        ]);

        $this->redirect("/games/{$game->id}/edit", navigate: true);
    }
};
