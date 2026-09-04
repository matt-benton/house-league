<?php

use App\Models\League;
use Flux\Flux;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

new #[Title('New League')] class extends Component
{
    #[Validate('required|max:255')]
    public string $name;

    public function mount()
    {
        $this->authorize('create', League::class);
    }

    public function save()
    {
        $this->authorize('create', League::class);

        $this->validate();

        $league = League::create(['name' => $this->name]);

        session()->put('league_id', $league->id);

        Flux::toast(variant: 'success', text: $this->name.' created successfully');

        $this->redirectRoute('dashboard', navigate: true);
    }
};
