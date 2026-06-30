<?php

use App\Models\Player;
use Flux\Flux;
use Livewire\Component;

new class extends Component
{
    public Player $player;

    public function mount(Player $player)
    {
        $this->authorize('update', $this->player);

        $this->player = $player;
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
};
