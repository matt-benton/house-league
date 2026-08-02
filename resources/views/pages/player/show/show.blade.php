<div class="max-w-md mx-auto">
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
        <div class="grid grid-cols-4 gap-y-3">
            <flux:text>Goals</flux:text>
            <flux:text>Saves</flux:text>
            <flux:text>Yellow Cards</flux:text>
            <flux:text>Red Cards</flux:text>

            <flux:heading size="xl">{{ $player->goals_count }}</flux:heading>
            <flux:heading size="xl">{{ $player->saves_count }}</flux:heading>
            <flux:heading size="xl">{{ $player->yellow_cards_count }}</flux:heading>
            <flux:heading size="xl">{{ $player->red_cards_count }}</flux:heading>
        </div>
        <flux:button href="/players/{{ $player->id }}/edit" icon="cog-6-tooth" class="mt-5" wire:navigate>Manage</flux:button>
    </flux:card>
</div>
