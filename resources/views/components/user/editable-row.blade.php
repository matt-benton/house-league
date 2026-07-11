<?php

use Livewire\Component;
use App\Models\User;

new class extends Component
{
    public User $user;

    public $isAdmin;

    public function mount(User $user)
    {
        $this->user = $user;

        $this->isAdmin = $user->is_admin;
    }
};
?>

<flux:table.row :key="$user->id">
    <flux:table.cell>{{ $user->name }}</flux:table.cell>
    <flux:table.cell>{{ $user->email }}</flux:table.cell>
    <flux:table.cell>
        <flux:field variant="inline">
            <flux:switch wire:model.live="isAdmin" />
        </flux:field>
    </flux:table.cell>
</flux:table.row>
