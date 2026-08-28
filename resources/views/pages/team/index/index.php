<?php

use App\Models\Team;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

new #[Title('Teams')] class extends Component
{
    use WithPagination;

    public string $sortBy = 'name';

    public string $sortDirection = 'asc';

    public function mount()
    {
        $this->authorize('viewAny', Team::class);
    }

    #[Computed]
    public function teams()
    {
        return Team::query()
            ->where('league_id', session('league_id'))
            ->when($this->sortBy, fn (Builder $query) => $query->orderBy($this->sortBy, $this->sortDirection))
            ->paginate();
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
            if (Str::contains($field, ['wins', 'losses', 'draws'])) {
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
