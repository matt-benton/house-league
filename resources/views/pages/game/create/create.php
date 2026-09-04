<?php

use App\Models\Game;
use App\Models\Team;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('New Match')] class extends Component
{
    public $home_team_id = '';

    public $away_team_id = '';

    public $teams;

    public function mount()
    {
        $this->authorize('create', Game::class);

        $this->teams = Team::query()->where('league_id', session('league_id'))->get();
    }

    public function save()
    {
        $validated = $this->validate();

        $homeTeam = Team::find($validated['home_team_id']);
        $game = $homeTeam->league->games()->create([
            'home_team_id' => $validated['home_team_id'],
            'away_team_id' => $validated['away_team_id'],
        ]);

        $this->redirect("/games/{$game->id}/edit", navigate: true);
    }

    protected function rules()
    {
        return [
            'home_team_id' => [
                'required',
                'exists:players,team_id',
            ],
            'away_team_id' => [
                'required',
                'different:home_team_id',
                'exists:players,team_id',
            ],
        ];
    }

    protected function validationAttributes()
    {
        return [
            'home_team_id' => 'home team',
            'away_team_id' => 'away team',
        ];
    }

    protected function messages()
    {
        return [
            'home_team_id.exists' => 'The :attribute needs at least one player',
            'away_team_id.exists' => 'The :attribute needs at least one player',
        ];
    }
};
