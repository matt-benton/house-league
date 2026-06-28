<?php

use App\Models\Team;
use Livewire\Component;

new class extends Component
{
    public Team $team;

    public function mount(Team $team)
    {
        $this->authorize('view', $team);

        $this->team = $team;
    }

    public function render()
    {
        return $this->view()
            ->title($this->team->name);
    }
};
