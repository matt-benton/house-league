
<div>
    <flux:breadcrumbs>
        <flux:breadcrumbs.item>New League</flux:breadcrumbs.item>
    </flux:breadcrumbs>
    <flux:card class="mt-9">
        <form wire:submit="save" class="space-y-5">
            <flux:field>
                <flux:label>Name</flux:label>
                <flux:input wire:model="name" autocomplete="off" />
                <flux:error name="name" />
            </flux:field>
            <div class="flex justify-end">
                <flux:button variant="primary" type="submit">Save</flux:button>
            </div>
        </form>
    </flux:card>
</div>
