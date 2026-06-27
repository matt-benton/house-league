<?php

use App\Models\Team;
use Livewire\Component;

new class extends Component
{
    public Team $team;

    public function mount(Team $team)
    {
        $this->team = $team;
    }
};

