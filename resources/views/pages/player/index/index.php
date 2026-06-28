<?php

use App\Models\Player;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Players')] class extends Component
{
    public $players;

    public function mount()
    {
        $this->authorize('viewAny', Player::class);

        $this->players = Player::all();
    }
};
