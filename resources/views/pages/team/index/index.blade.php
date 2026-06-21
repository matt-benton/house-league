<div>
    <flux:heading size="lg" class="mb-3">Teams</flux:heading>
    <ul class="space-y-3">
        @foreach ($teams as $team)
            <li>
                <flux:card>
                    <flux:link href="/teams/{{ $team->id }}" variant="ghost">{{ $team->abbreviation }} - {{ $team->name }}</flux:text>
                </flux:card>
            </li>
        @endforeach
    </ul>
    <flux:button href="/teams/create" class="mt-6 float-end" variant="primary" wire:navigate>New Team</flux:button>
</div>
