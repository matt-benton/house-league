
<div>
    <flux:breadcrumbs>
        <flux:breadcrumbs.item href="/teams" wire:navigate>Teams</flux:breadcrumbs.item>
        <flux:breadcrumbs.item>{{ $team->name }}</flux:breadcrumbs.item>
    </flux:breadcrumbs>
    <flux:card class="mt-7">
        <flux:heading size="lg">{{ $team->abbreviation }} - {{ $team->name }}</flux:heading>
        <flux:button href="/teams/{{ $team->id }}/edit" icon="cog-6-tooth" class="mt-5" wire:navigate>Manage</flux:button>
        <flux:heading class="mb-5 mt-7">Roster</flux:heading>
        @if ($team->roster->count())
            <ul class="space-y-3">
                @foreach ($team->roster as $player)
                    <li>
                        <flux:card class="flex items-center gap-2">
                            <flux:link href="/players/{{ $player->id }}">#{{ $player->number }} {{ $player->name }}</flux:link><flux:text>{{ $player->position }}</flux:text>
                        </flux:card>
                    </li>
                @endforeach
            </ul>
        @else
            <flux:card>
                <flux:text color="lime">No players on this team yet</flux:text>
            </flux:card>
        @endif
    </flux:card>
</div>
