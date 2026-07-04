
<div>
    <flux:heading size="lg" class="mb-7">New Post</flux:heading>
    <form wire:submit="publish" class="space-y-5">
        <flux:field>
            <flux:label>Title</flux:label>
            <flux:input wire:model="title" autocomplete="off" />
            <flux:error name="title" />
        </flux:field>
        <flux:editor wire:model="text" label="Text" />
        <flux:button type="submit" variant="primary" icon="pencil" class="float-end">Publish</flux:button>
    </form>
</div>
