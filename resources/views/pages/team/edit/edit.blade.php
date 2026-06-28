<div>
    <flux:breadcrumbs class="mb-9">
        <flux:breadcrumbs.item href="/teams" wire:navigate>Teams</flux:breadcrumbs.item>
        <flux:breadcrumbs.item href="/teams/{{ $team->id }}" wire:navigate>{{ $team->name }}</flux:breadcrumbs.item>
        <flux:breadcrumbs.item>Manage Team</flux:breadcrumbs.item>
    </flux:breadcrumbs>

    @unless ($team->trashed())
        <flux:card>
            <form wire:submit="save" class="space-y-5">
                <flux:input label="Team Name" wire:model="name" autocomplete="off" />

                <flux:field>
                    <flux:label>Abbreviation</flux:label>
                    <flux:input maxlength="3" wire:model="abbreviation" autocomplete="off" />
                    <flux:error name="abbreviation" />
                </flux:field>

                <div class="flex justify-end">
                    <flux:button variant="primary" type="submit">Save</flux:button>
                </div>
            </form>
        </flux:card>
        <flux:button variant="filled" icon="trash" wire:click="delete" class="mt-3">Delete Team</flux:button>
    @else
        <flux:callout color="amber" icon="trash">
            <flux:callout.heading>This team has been deleted</flux:callout.heading>
            <flux:callout.text>If this was not intended you can restore the team</flux:callout.text>
            <x-slot name="actions">
                <flux:button href="/teams" variant="primary" wire:navigate>Go to Teams</flux:button>
                <flux:button wire:click="restore">Restore</flux:button>
            </x-slot>
        </flux:callout>
    @endunless
</div>
