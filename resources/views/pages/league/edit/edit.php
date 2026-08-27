<?php

use App\Models\League;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Manage League')] class extends Component
{
    public League $league;

    public string $name;

    public function mount(League $league)
    {
        $this->authorize('update', $league);

        $this->league = $league;

        $this->name = $league->name;
    }

    public function delete()
    {
        $this->league->delete();
    }

    public function restore()
    {
        $this->league->restore();
    }
};
