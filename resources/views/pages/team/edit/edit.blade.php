<div>
    <flux:breadcrumbs>
        <flux:breadcrumbs.item href="/teams" wire:navigate>Teams</flux:breadcrumbs.item>
        <flux:breadcrumbs.item href="/teams/{{ $team->id }}" wire:navigate>{{ $team->name }}</flux:breadcrumbs.item>
        <flux:breadcrumbs.item>Manage Team</flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <flux:card class="mt-9">
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
</div>
