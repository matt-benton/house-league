
<div>
    <flux:breadcrumbs class="mb-9">
        <flux:breadcrumbs.item href="/leagues/{{ $league->id }}" wire:navigate>
            {{ $league->name }}
        </flux:breadcrumbs.item>
        <flux:breadcrumbs.item>Manage</flux:breadcrumbs.item>
    </flux:breadcrumbs>
    @unless ($league->trashed())
        <flux:card>
            <form wire:submit="save" class="space-y-5">
                <flux:input wire:model="name" label="Name" />

                <div class="flex justify-end">
                    <flux:button variant="primary" type="submit">Save</flux:button>
                </div>
            </form>
        </flux:card>
        <flux:button variant="filled" icon="trash" wire:click="delete" class="mt-3">Delete League</flux:button>
    @else
        <flux:callout color="amber" icon="trash">
            <flux:callout.heading>This league has been deleted</flux:callout.heading>
            <flux:callout.text>If this was not intended you can restore the league</flux:callout.text>
            <x-slot name="actions">
                <flux:button wire:click="restore">Restore</flux:button>
            </x-slot>
        </flux:callout>
    @endunless
</div>
