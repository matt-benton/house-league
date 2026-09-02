<?php

use App\Models\Game;
use App\Models\League;
use App\Models\Post;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

new class extends Component
{
    use WithPagination;

    public League $league;

    public function mount()
    {
        $this->authorize('viewAny', Post::class);

        $this->league = League::find(session('league_id'));
    }

    #[Computed]
    public function posts()
    {
        return Post::query()
            ->where('league_id', $this->league->id)
            ->latest()
            ->paginate(10);
    }

    #[Computed]
    public function matches()
    {
        return Game::query()
            ->where('league_id', $this->league->id)
            ->latest()
            ->limit(5)
            ->get();
    }
};
