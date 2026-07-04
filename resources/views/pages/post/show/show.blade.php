<div>
    <flux:breadcrumbs class="mb-7">
        <flux:breadcrumbs.item href="/dashboard" icon="home" wire:navigate />
    </flux:breadcrumbs>
    <flux:card>
        <flux:heading size="lg" class="mb-2">{{ $post->title }}</flux:heading>
        <flux:text variant="subtle">Published {{ $post->created_at->diffForHumans() }}</flux:text>
        <div class="space-y-3">
            <flux:text>{!! $post->text !!}</flux:text>
        </div>
    </flux:card>
</div>
