<?php

use App\Models\Team;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Teams')] class extends Component
{
    public $teams;

    public $foo;

    public function mount()
    {
        $this->authorize('viewAny', Team::class);

        $this->teams = Team::all();
    }
};
