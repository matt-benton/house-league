
<div>
    <flux:breadcrumbs>
        <flux:breadcrumbs.item href="/players" wire:navigate>Players</flux:breadcrumbs.item>
        <flux:breadcrumbs.item>{{ $player->name }}</flux:breadcrumbs.item>
    </flux:breadcrumbs>
    <flux:card class="mt-7 space-y-5">
        <flux:heading size="xl">#{{ $player->number }} {{ $player->name }}</flux:heading>
        <flux:text>{{ ucfirst($player->position->value) }}</flux:text>
        @if ($player->team)
            <div>
                <flux:link variant="ghost" href="/teams/{{ $player->team->id }}" wire:navigate>
                    {{ $player->team->name }}
                </flux:link>
            </div>
        @else
            <flux:text>No team</flux:text>
        @endif
        <flux:button href="/players/{{ $player->id }}/edit" icon="cog-6-tooth" class="mt-5" wire:navigate>Manage</flux:button>
    </flux:card>
</div>
