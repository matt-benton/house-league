<div>
    <flux:breadcrumbs>
        <flux:breadcrumbs.item>{{ $league->name }}</flux:breadcrumbs.item>
    </flux:breadcrumbs>
    <flux:button href="/leagues/{{ $league->id }}/edit" icon="cog-6-tooth" class="mt-5" wire:navigate>Manage</flux:button>
</div>
