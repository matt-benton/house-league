<?php

use App\Models\User;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

new #[Title('Users')] class extends Component
{
    use WithPagination;

    public function mount()
    {
        $this->authorize('viewAny', User::class);
    }

    #[Computed]
    public function users()
    {
        return User::query()->orderBy('email')->paginate();
    }
};
