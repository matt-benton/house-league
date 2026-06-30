<?php

use App\Models\Player;
use Livewire\Component;

new class extends Component
{
    public Player $player;

    public function mount(Player $player)
    {
        $this->player = $player;
    }

    public function render()
    {
        return $this->view()
            ->title($this->player->name);
    }
};
