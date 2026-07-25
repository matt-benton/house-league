<div>
    <flux:heading size="xl" class="mb-3">Matches</flux:heading>

    @if ($this->games->isNotEmpty())
        <div class="mb-4">
            <flux:pagination :paginator="$this->games" />
        </div>

        <div class="grid xl:grid-cols-6 lg:grid-cols-4 md:grid-cols-3 gap-6">
            @foreach ($this->games as $game)
                <div wire:key="game-{{ $game->id }}">
                    <flux:card size="sm">
                        <x-score-card :match="$game" />
                    </flux:card>
                </div>
            @endforeach
        </div>
    @else
        <flux:callout icon="clock">No matches yet. Stay tuned!</flux:callout>
    @endif
</div>
