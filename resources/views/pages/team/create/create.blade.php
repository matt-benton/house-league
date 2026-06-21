<div>
    <flux:breadcrumbs>
        <flux:breadcrumbs.item href="/teams" wire:navigate>Teams</flux:breadcrumbs>
        <flux:breadcrumbs.item href="/teams">New Team</flux:breadcrumbs>
    </flux:breadcrumbs>

    <flux:card class="mt-9">
        <form wire:submit="save" class="space-y-5">
            <flux:input label="Team Name" wire:model="name" />

            <flux:field>
                <flux:label>Abbreviation</flux:label>
                <flux:input placeholder="ABC" maxlength="3" wire:model="abbreviation" />
                <flux:error name="abbreviation" />
            </flux:field>

            <div class="flex justify-end">
                <flux:button variant="primary" type="submit">Save</flux:button>
            </div>
        </form>
    </flux:card>
</div>
