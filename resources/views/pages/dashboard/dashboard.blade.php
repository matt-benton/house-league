<div class="max-w-md mx-auto">
    @if(auth()->user()?->is_admin)
        <flux:heading size="xl" class="mb-3">Actions</flux:heading>
        <flux:card class="space-y-2 mb-5">
            <flux:button
                variant="primary"
                href="{{ route('posts.create') }}"
                icon="pencil"
                wire:navigate
                size="sm"
                class="w-full"
            >
                New Blog Post
            </flux:button>
            <flux:button
                variant="primary"
                href="{{ route('games.create') }}"
                icon="ticket"
                wire:navigate
                size="sm"
                class="w-full"
            >
                New Match
            </flux:button>
        </flux:card>
    @endif

    <flux:heading size="xl" class="mb-3">Latest Scores</flux:heading>
    @if ($this->matches->isEmpty())
        <flux:callout icon="clock">
            <flux:callout.heading>Stay tuned</flux:callout.heading>
            <flux:callout.text>Check back soon for live scores</flux:callout.text>
        </flux:callout>
    @else
        @foreach ($this->matches as $match)
            <a href="/games/{{ $match->id }}" wire:navigate>
                <div class="py-4">
                    <x-score-card :match="$match" />
                </div>
            </a>
            @unless ($loop->last)
                <flux:separator />
            @endunless
        @endforeach
        <flux:link href="/games" wire:navigate class="text-xs">View All</flux:link>
    @endif

    <flux:heading size="xl" class="mb-3 mt-5">Headlines</flux:heading>
    @if ($this->posts->isNotEmpty())
        @foreach ($this->posts as $post)
            <flux:heading size="lg" class="mb-3">
                <flux:link href="/posts/{{ $post->id }}" wire:navigate>{{ $post->title }}</flux:link>
            </flux:heading>
        @endforeach

        <flux:pagination :paginator="$this->posts" />
    @else
        <flux:callout icon="clock" color="lime">
            <flux:callout.heading>Stay tuned</flux:callout.heading>
            <flux:callout.text>Check back soon for news about House League!</flux:callout.text>
        </flux:callout>
    @endif
</div>
