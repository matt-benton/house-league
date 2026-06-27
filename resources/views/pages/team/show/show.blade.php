
<div>
    <flux:breadcrumbs>
        <flux:breadcrumbs.item href="/teams" wire:navigate>Teams</flux:breadcrumbs.item>
        <flux:breadcrumbs.item>{{ $team->name }}</flux:breadcrumbs.item>
    </flux:breadcrumbs>
    <flux:card class="mt-7">
        <flux:heading size="lg">{{ $team->abbreviation }} - {{ $team->name }}</flux:heading>
        <flux:button href="/teams/{{ $team->id }}/edit" icon="cog-6-tooth" class="mt-5">Manage</flux:button>
    </flux:card>
</div>
