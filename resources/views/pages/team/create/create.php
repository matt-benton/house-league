<?php

use App\Models\Team;
use Flux\Flux;
use Livewire\Attributes\Validate;
use Livewire\Component;

new class extends Component
{
    #[Validate('required|size:3|unique:teams,abbreviation')]
    public string $abbreviation;

    #[Validate('required|max:45|unique:teams,name')]
    public string $name;

    public function mount()
    {
        $this->authorize('create', Team::class);
    }

    public function save()
    {
        $this->validate();

        Team::create([
            'abbreviation' => $this->abbreviation,
            'name' => $this->name,
        ]);

        Flux::toast(variant: 'success', text: $this->name.' created successfully');

        return $this->redirect('/teams', navigate: true);
    }
};
