<?php

use App\Models\Post;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

new class extends Component
{
    use WithPagination;

    public function mount()
    {
        $this->authorize('viewAny', Post::class);
    }

    #[Computed]
    public function posts()
    {
        return Post::query()
            ->latest()
            ->paginate(10);
    }
};
