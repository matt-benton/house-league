
<div>
    <flux:breadcrumbs class="mb-9">
        <flux:breadcrumbs.item href="/players" wire:navigate>Players</flux:breadcrumbs.item>
        <flux:breadcrumbs.item href="/players/{{ $player->id }}" wire:navigate>{{ $player->name }}</flux:breadcrumbs.item>
        <flux:breadcrumbs.item>Manage Player</flux:breadcrumbs.item>
    </flux:breadcrumbs>

    @unless ($player->trashed())
        <flux:card class="mt-9">
            <form wire:submit="save" class="space-y-5">
                <flux:field>
                    <flux:label>Name</flux:label>
                    <flux:input wire:model="name" autocomplete="off" />
                    <flux:error name="name" />
                </flux:field>

                <flux:field>
                    <flux:label>Number</flux:label>
                    <flux:input wire:model="number" autocomplete="off" maxlength="2" />
                    <flux:error name="number" />
                </flux:field>

                <flux:field>
                    <flux:label>Position</flux:label>
                    <flux:select wire:model="position" placeholder="Choose position...">
                        @foreach ($positions as $position)
                            <flux:select.option>{{ $position }}</flux:select.option>
                        @endforeach
                    </flux:select>
                    <flux:error name="position" />
                </flux:field>

                <flux:field>
                    <flux:label>Team</flux:label>
                    <flux:select wire:model="teamId">
                        <flux:select.option value="">None</flux:select.option>
                        @foreach ($teams as $team)
                            <flux:select.option value="{{ $team->id }}">{{ $team->name }}</flux:select.option>
                        @endforeach
                    </flux:select>
                    <flux:error name="teamId" />
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
