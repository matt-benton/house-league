<div class="max-w-md mx-auto">
    <flux:breadcrumbs>
        <flux:breadcrumbs.item href="/players" wire:navigate>Players</flux:breadcrumbs.item>
        <flux:breadcrumbs.item>{{ $player->name }}</flux:breadcrumbs.item>
    </flux:breadcrumbs>
    <flux:card class="mt-7 space-y-9">
        <div>
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
        </div>
        <div>
            <flux:separator text="Quality" />
            <div class="grid grid-cols-3 gap-y-3 mt-5 items-center">
                <flux:heading align="center">Goals</flux:heading>
                <flux:heading align="center">Assists</flux:heading>
                <flux:heading align="center">Saves</flux:heading>

                <flux:heading align="center" size="xl">{{ $player->goals_count }}</flux:heading>
                <flux:heading align="center" size="xl">{{ $player->assists_count }}</flux:heading>
                <flux:heading align="center" size="xl">{{ $player->saves_count }}</flux:heading>
            </div>
        </div>
        <div>
            <flux:separator text="Discipline" />
            <div class="grid grid-cols-2 gap-y-3 mt-5 items-center">
                <flux:heading align="center">Yellow Cards</flux:heading>
                <flux:heading align="center">Red Cards</flux:heading>

                <flux:heading align="center" size="xl">{{ $player->yellow_cards_count }}</flux:heading>
                <flux:heading align="center" size="xl">{{ $player->red_cards_count }}</flux:heading>
            </div>
        </div>
        <flux:button href="/players/{{ $player->id }}/edit" icon="cog-6-tooth" class="mt-5" wire:navigate>Manage</flux:button>
    </flux:card>
</div>
