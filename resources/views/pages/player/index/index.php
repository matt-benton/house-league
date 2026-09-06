<?php

use App\Models\Player;
use App\Models\Team;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

new #[Title('Players')] class extends Component
{
    use WithPagination;

    public string $sortBy = 'name';

    public string $sortDirection = 'asc';

    public $selectedLeagueId;

    public $selectedTeamId;

    public $teams;

    public function mount()
    {
        $this->authorize('viewAny', Player::class);

        $this->selectedLeagueId = session('league_id');

        $this->teams = Team::query()->where('league_id', $this->selectedLeagueId)->get();

        $this->selectedTeamId = '';
    }

    #[Computed]
    public function players()
    {
        return Player::query()
            ->select(
                'players.*',
                'teams.name as team_name',
                'teams.league_id',
            )
            ->leftJoin('teams', 'teams.id', '=', 'players.team_id')
            ->withCount(
                'goals',
                'saves',
                'redCards',
                'yellowCards',
                'assists',
            )
            ->when($this->sortBy, fn (Builder $query) => $query->orderBy($this->sortBy, $this->sortDirection))
            ->when($this->selectedTeamId, function (Builder $query) {
                $query->where('players.team_id', $this->selectedTeamId);
            })
            ->when($this->selectedTeamId == 0,
                fn (Builder $query) => $query->whereNull('players.team_id'),
                fn (Builder $query) => $query->where('league_id', $this->selectedLeagueId),
            )
            ->paginate(30);
    }

    public function setSortBy(string $field)
    {
        $this->toggleSortDirection($field);

        $this->sortBy = $field;
    }

    private function toggleSortDirection($field)
    {
        if ($this->sortBy != $field) {
            // the sortBy was changed
            if (Str::contains($field, 'count')) {
                $this->sortDirection = 'desc';
            } else {
                $this->sortDirection = 'asc';
            }
        } else {
            if ($this->sortDirection === 'desc') {
                $this->sortDirection = 'asc';
            } else {
                $this->sortDirection = 'desc';
            }
        }
    }
};
