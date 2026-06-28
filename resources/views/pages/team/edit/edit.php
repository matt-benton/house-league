<?php

use App\Models\Team;
use Flux\Flux;
use Illuminate\Validation\Rule;
use Livewire\Component;

new class extends Component
{
    public Team $team;

    public string $abbreviation;

    public string $name;

    public function mount(Team $team)
    {
        $this->authorize('update', $team);

        $this->team = $team;
        $this->abbreviation = $team->abbreviation;
        $this->name = $team->name;
    }

    public function render()
    {
        return $this->view()
            ->title('Manage: '.$this->team->name);
    }

    public function save()
    {
        $this->validate();

        $this->team->abbreviation = $this->abbreviation;
        $this->team->name = $this->name;
        $this->team->save();

        Flux::toast(variant: 'success', text: 'Team has been updated');
    }

    public function delete()
    {
        $this->authorize('delete', $this->team);

        $this->team->delete();

        Flux::toast(variant: 'success', text: 'Team has been deleted');
    }

    public function restore()
    {
        $this->authorize('restore', $this->team);

        $this->team->restore();

        Flux::toast(variant: 'success', text: 'Team has been restored');
    }

    public function updatedAbbreviation(string $value): void
    {
        $this->abbreviation = strtoupper($value);
    }

    protected function rules()
    {
        return [
            'abbreviation' => [
                'required',
                'size:3',
                Rule::unique('teams', 'abbreviation')->ignore($this->team->id),
            ],
            'name' => [
                'required',
                'max:45',
                Rule::unique('teams', 'name')->ignore($this->team->id),
            ],
        ];
    }
};
