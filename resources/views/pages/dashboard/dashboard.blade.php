<div>
    @if(auth()->user()?->is_admin)
        <flux:heading size="xl" class="mb-3">Actions</flux:heading>
        <flux:card class="space-y-2">
            <flux:button
                variant="primary"
                href="/posts/create"
                icon="pencil"
                wire:navigate
                size="sm"
                class="w-full"
            >
                New Blog Post
            </flux:button>
            <flux:button
                variant="primary"
                href="/matches/create"
                icon="ticket"
                wire:navigate
                size="sm"
                class="w-full"
            >
                New Match
            </flux:button>
        </flux:card>
    @endif
    <flux:heading size="xl" class="my-3">News</flux:heading>
    @if ($this->posts->isNotEmpty())
        <flux:card class="space-y-11">
            @foreach ($this->posts as $post)
                <div>
                    <flux:heading size="lg" class="mb-3">
                        <flux:link href="/posts/{{ $post->id }}" wire:navigate>{{ $post->title }}</flux:link>
                    </flux:heading>
                    <flux:text variant="subtle">Published {{ $post->created_at->diffForHumans() }}</flux:text>
                    <div class="space-y-3">
                        <flux:text>{!! $post->text !!}</flux:text>
                    </div>
                </div>
                <flux:separator />
            @endforeach

            <flux:pagination :paginator="$this->posts" />
        </flux:card>
    @else
        <flux:callout icon="clock" color="lime">
            <flux:callout.heading>Stay tuned</flux:callout.heading>
            <flux:callout.text>Check back soon for news about House League!</flux:callout.text>
        </flux:callout>
    @endif
</div>
