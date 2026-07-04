<div>
    <flux:breadcrumbs class="mb-7">
        <flux:breadcrumbs.item href="/dashboard" icon="home" wire:navigate />
    </flux:breadcrumbs>
    <flux:card class="mb-3">
        <flux:heading size="lg" class="mb-2">{{ $post->title }}</flux:heading>
        <flux:text variant="subtle">Published {{ $post->created_at->diffForHumans() }}</flux:text>
        <div class="space-y-3">
            <flux:text>{!! $post->text !!}</flux:text>
        </div>
    </flux:card>
    <flux:button
        href="/posts/{{ $post->id }}/edit"
        wire:navigate
        icon="pencil-square"
        class="float-right"
    >
        Edit Post
    </flux:button>
</div>
