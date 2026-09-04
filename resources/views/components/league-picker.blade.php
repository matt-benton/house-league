<?php

use Livewire\Component;
use App\Models\League;

new class extends Component
{
    public $leagues;

    public $selectedLeague;

    public function mount()
    {
        $this->leagues = League::query()->orderBy('id')->get();

        $this->selectedLeague = $this->leagues->firstWhere('id', session('league_id'));
    }

    public function switchLeague($leagueId)
    {
        $league = League::findOrFail($leagueId);

        session()->put('league_id', $leagueId);

        $this->selectedLeague = $league;

        $this->redirectRoute('dashboard', navigate: true);
    }
};
?>

<flux:dropdown position="top" align="start">
    <flux:profile name="{{ $selectedLeague->name }}" icon:trailing="chevron-up-down" />

    <flux:menu>
        <flux:menu.radio.group>
            @foreach ($leagues as $league)
                <flux:menu.radio wire:click="switchLeague({{ $league->id }})">
                    {{ $league->name }}
                </flux:menu.radio>
            @endforeach
        </flux:menu.radio.group>

        <flux:menu.separator />

        <flux:navlist.item icon="plus" href="/leagues/create" wire:navigate>New League</flux:navlist.item>
    </flux:menu>
</flux:dropdown>
