<?php

use App\Models\League;
use Livewire\Component;

new class extends Component
{
    public League $league;

    public function mount(League $league)
    {
        $this->league = $league;
    }
};
