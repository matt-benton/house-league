<?php

use App\Enums\Position;
use App\Models\Player;
use App\Models\Team;
use Flux\Flux;
use Illuminate\Validation\Rule;
use Livewire\Component;

new class extends Component
{
    public Player $player;

    public string $name;

    public string $number;

    public string $position;

    public array $positions;

    public $teamId;

    public $teams;

    public function mount(Player $player)
    {
        $this->authorize('update', $this->player);

        $this->player = $player;

        $this->name = $player->name;

        $this->number = $player->number;

        $this->position = $player->position->value;
        $this->positions = Position::values();

        $this->teamId = $player->team_id;
        $this->teams = Team::all();
    }

    public function save()
    {
        $this->validate();

        $this->player->name = $this->name;
        $this->player->number = $this->number;
        $this->player->team_id = $this->teamId;
        $this->player->position = $this->position;
        $this->player->save();

        Flux::toast(variant: 'success', text: 'Player has been updated');
    }

    public function delete()
    {
        $this->authorize('delete', $this->player);

        $this->player->delete();

        Flux::toast(variant: 'success', text: 'Player has been deleted');
    }

    public function restore()
    {
        $this->authorize('restore', $this->player);

        $this->player->restore();

        Flux::toast(variant: 'success', text: 'Player has been restored');
    }

    public function render()
    {
        return $this->view()
            ->title('Manage: '.$this->player->name);
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
};
