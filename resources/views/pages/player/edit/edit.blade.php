
<div>
    <flux:breadcrumbs class="mb-9">
        <flux:breadcrumbs.item href="/players" wire:navigate>Players</flux:breadcrumbs.item>
        <flux:breadcrumbs.item href="/players/{{ $player->id }}" wire:navigate>{{ $player->name }}</flux:breadcrumbs.item>
        <flux:breadcrumbs.item>Manage Player</flux:breadcrumbs.item>
    </flux:breadcrumbs>

    @unless ($player->trashed())
        <flux:card>
            <form wire:submit="save" class="space-y-5">
                <flux:field>
                    <flux:label>Player Name</flux:label>
                    <flux:input wire:model="name" autocomplete="off" />
                    <flux:error name="name" />
                </flux:field>

                <div class="flex justify-end">
                    <flux:button variant="primary" type="submit">Save</flux:button>
                </div>
            </form>
        </flux:card>
        <flux:button variant="filled" icon="trash" wire:click="delete" class="mt-3">Delete Player</flux:button>
    @else
        <flux:callout color="amber" icon="trash">
            <flux:callout.heading>This player has been deleted</flux:callout.heading>
            <flux:callout.text>If this was not intended you can restore the player</flux:callout.text>
            <x-slot name="actions">
                <flux:button href="/players" variant="primary" wire:navigate>Go to Players</flux:button>
                <flux:button wire:click="restore">Restore</flux:button>
            </x-slot>
        </flux:callout>
    @endunless
</div>
