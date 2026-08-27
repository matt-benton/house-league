<?php

use App\Models\League;
use Flux\Flux;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

new #[Title('Manage League')] class extends Component
{
    public League $league;

    #[Validate('required|max:255')]
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

    public function save()
    {
        $this->validate();

        $this->league->name = $this->name;
        $this->league->save();

        Flux::toast(variant: 'success', text: 'League has been renamed');
    }
};
