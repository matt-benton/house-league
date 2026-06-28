<div>
    <flux:heading size="lg" class="mb-3">Players</flux:heading>
    <ul class="space-y-3">
        @foreach ($players as $player)
            <flux:card class="space-y-3">
                <flux:heading size="lg">
                    <flux:link href="/players/{{ $player->id }}" variant="ghost">{{ $player->name }}</flux:link>
                </flux:heading>
                <flux:text>{{ $player->number }} - {{ ucfirst($player->position) }}</flux:text>
                <flux:text>
                    @if ($player->team_id)
                        <flux:link href="/teams/{{ $player->team_id }}" variant="ghost" wire:navigate>{{ $player->team->name }}</flux:link>
                    @else
                        No Team
                    @endif
                </flux:text>
            </flux:card>
        @endforeach
    </ul>
</div>
