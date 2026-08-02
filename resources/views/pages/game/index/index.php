<?php

use App\Models\Game;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

new #[Title('Matches')] class extends Component
{
    use WithPagination;

    public function mount(): void
    {
        $this->authorize('viewAny', Game::class);
    }

    /** @return Collection<int, Game> */
    #[Computed]
    public function games(): LengthAwarePaginator
    {
        return Game::query()
            ->with(['homeTeam', 'awayTeam', 'goals'])
            ->latest()
            ->paginate(50);
    }
};
