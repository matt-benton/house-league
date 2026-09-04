<?php

use App\Enums\Position;
use App\Models\League;
use App\Models\Player;
use Flux\Flux;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('New Player')] class extends Component
{
    public string $name;

    public string $number;

    public Position $position;

    public array $positions;

    public $teamId;

    public $leagues;

    public function mount()
    {
        $this->authorize('create', Player::class);

        $this->positions = Position::values();
        $this->position = Position::Forward;
        $this->leagues = League::query()->with('teams')->get();
    }

    public function save()
    {
        $validated = $this->validate();

        Player::create([
            'name' => $validated['name'],
            'number' => $validated['number'],
            'position' => $validated['position'],
            'team_id' => $validated['teamId'],
        ]);

        Flux::toast(variant: 'success', text: $this->name.' created successfully');

        return $this->redirect('/players', navigate: true);
    }

    protected function rules()
    {
        return [
            'name' => 'required',
            'number' => 'required|numeric|between:1,99',
            'position' => ['required', Rule::enum(Position::class)],
            'teamId' => 'nullable|exists:teams,id',
        ];
    }

    protected function prepareForValidation($attributes): array
    {
        $attributes['teamId'] = $attributes['teamId'] === '' ? null : $attributes['teamId'];

        return $attributes;
    }

    protected function validationAttributes()
    {
        return [
            'teamId' => 'team',
        ];
    }
};
