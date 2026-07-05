<div>
    <flux:breadcrumbs class="mb-7">
        <flux:breadcrumbs.item href="/dashboard" icon="home" wire:navigate />
        <flux:breadcrumbs.item href="/posts/{{ $post->id }}" wire:navigate>{{ $post->title }}</flux:breadcrumb>
        <flux:breadcrumbs.item>Edit Post</flux:breadcrumb>
    </flux:breadcrumbs>

    <form wire:submit="save" class="space-y-5">
        <flux:field>
            <flux:label>Title</flux:label>
            <flux:input wire:model="title" autocomplete="off" />
            <flux:error name="title" />
        </flux:field>
        <flux:editor wire:model="text" label="Text" />
        <flux:button type="submit" variant="primary" icon="pencil" class="float-end">Save</flux:button>
    </form>

    <flux:modal.trigger name="delete">
        <flux:button
            icon="trash"
            class="float-right mr-1"
        >
            Delete
        </flux:button>
    </flux:modal.trigger>

    <flux:modal name="delete" class="min-w-[22rem]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Delete post permanently?</flux:heading>
                <flux:text class="mt-2">
                    This action cannot be reversed.
                </flux:text>
            </div>
            <div class="flex gap-2">
                <flux:spacer />
                <flux:modal.close>
                    <flux:button variant="ghost">Cancel</flux:button>
                </flux:modal.close>
                <flux:button type="submit" variant="danger" wire:click="delete">Delete Post</flux:button>
            </div>
        </div>
    </flux:modal>
</div>
