<div>
    <flux:heading size="lg" class="mb-3">Teams</flux:heading>
    <ul class="space-y-3">
        @foreach ($teams as $team)
            <li>
                <flux:card class="flex items-baseline gap-2">
                    <flux:link href="/teams/{{ $team->id }}" variant="ghost">{{ $team->name }}</flux:link>
                    <flux:text>({{ $team->abbreviation }})</flux:text>
                    <flux:text>{{ $team->record }}</flux:text>
                </flux:card>
            </li>
        @endforeach
    </ul>
    <flux:button href="/teams/create" class="mt-6 float-end" variant="primary" icon="flag" wire:navigate>New Team</flux:button>
</div>
