<div class="max-w-md mx-auto">
    <flux:heading size="lg">New Post</flux:heading>
    <flux:text size="sm" class="mt-1 mb-7" color="indigo" variant="subtle">{{ $league->name }}</flux:text>
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
