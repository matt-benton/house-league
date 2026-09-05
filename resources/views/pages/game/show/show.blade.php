@use('App\Enums\GameEventType')
<div class="max-w-md mx-auto">
    <flux:breadcrumbs>
        <flux:breadcrumbs.item :href="route('games.index')" wire:navigate>Matches</flux:breadcrumbs.item>
        <flux:breadcrumbs.item>{{ $game->homeTeam->abbreviation }} vs {{ $game->awayTeam->abbreviation }}</flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <flux:card class="mt-7">
        <div class="flex justify-center">
            @if ($game->is_complete)
                <flux:badge>Full Time</flux:badge>
            @else
                <flux:badge color="red" variant="solid">Live</flux:badge>
            @endif
        </div>

        <div class="mt-6 grid grid-cols-[1fr_auto_1fr] items-center gap-4 sm:gap-8">
            <div class="min-w-0 text-center">
                <flux:text class="truncate" variant="subtle">Home</flux:text>
                <flux:heading size="lg" class="mt-1">{{ $game->homeTeam->name }}</flux:heading>
                <flux:text>{{ $game->homeTeam->record }}</flux:text>
            </div>

            <div class="flex items-center gap-3 sm:gap-5">
                <span class="text-2xl font-semibold tabular-nums text-zinc-900 dark:text-white sm:text-6xl">{{ $this->homeScore }}</span>
                <span class="text-xl text-zinc-400 sm:text-2xl">-</span>
                <span class="text-2xl font-semibold tabular-nums text-zinc-900 dark:text-white sm:text-6xl">{{ $this->awayScore }}</span>
            </div>

            <div class="min-w-0 text-center">
                <flux:text class="truncate" variant="subtle">Away</flux:text>
                <flux:heading size="lg" class="mt-1">{{ $game->awayTeam->name }}</flux:heading>
                <flux:text>{{ $game->awayTeam->record }}</flux:text>
            </div>
        </div>

        @if ($game->is_complete)
            <div class="mt-7 text-center">
                @if ($this->homeScore > $this->awayScore)
                    <flux:text variant="strong">{{ $game->homeTeam->name }} won the match.</flux:text>
                @elseif ($this->awayScore > $this->homeScore)
                    <flux:text variant="strong">{{ $game->awayTeam->name }} won the match.</flux:text>
                @else
                    <flux:text variant="strong">The match ended in a draw.</flux:text>
                @endif
            </div>
        @endif
    </flux:card>

    <flux:separator text="Highlights" variant="subtle" class="my-9" />

    @if ($game->events->isNotEmpty())
        <flux:timeline>
            @foreach ($game->events as $event)
                <flux:timeline.item wire:key="game-event-{{ $event->id }}">
                    @switch ($event->type)
                        @case(GameEventType::Goal->value)
                            <flux:timeline.indicator color="green">
                                <flux:icon.check variant="micro" />
                            </flux:timeline.indicator>
                            @break

                        @case(GameEventType::YellowCard->value)
                            <flux:timeline.indicator color="yellow">
                                <flux:icon.exclamation-triangle variant="micro" />
                            </flux:timeline.indicator>
                            @break

                        @case(GameEventType::RedCard->value)
                            <flux:timeline.indicator color="red">
                                <flux:icon.x-mark variant="micro" />
                            </flux:timeline.indicator>
                            @break

                        @case(GameEventType::Save->value)
                            <flux:timeline.indicator>
                                <flux:icon.no-symbol variant="micro" />
                            </flux:timeline.indicator>
                            @break
                    @endswitch

                    <flux:timeline.content>
                        @switch ($event->type)
                            @case(GameEventType::Goal->value)
                                <flux:text>Goal by {{ $event->player->name }} ({{ $event->team->abbreviation }})</flux:text>
                                @if ($event->secondaryEvent)
                                    <flux:text size="sm" class="mt-1">Assist by {{ $event->secondaryEvent->player->name }}</flux:text>
                                @endif
                                @break

                            @case(GameEventType::YellowCard->value)
                                <flux:text>Yellow card given to {{ $event->player->name }} ({{ $event->team->abbreviation }})</flux:text>
                                @break

                            @case(GameEventType::RedCard->value)
                                <flux:text>Red card given to {{ $event->player->name }} ({{ $event->team->abbreviation }})</flux:text>
                                @break

                            @case(GameEventType::Save->value)
                                <flux:text>Save by {{ $event->player->name }} ({{ $event->team->abbreviation }})</flux:text>
                                @break
                        @endswitch
                    </flux:timeline.content>
                </flux:timeline.item>
            @endforeach

            @unless ($game->is_complete)
                <flux:timeline.item>
                    <flux:timeline.block>
                        <flux:callout variant="secondary">
                            <flux:callout.heading>Match still in progress</flux:callout.heading>

                            <x-slot name="actions">
                                <flux:button variant="primary" href="/games/{{ $game->id }}/edit" wire:navigate>
                                    Continue Match
                                </flux:button>
                            </x-slot>
                        </flux:callout>
                    </flux:timelime.block>
                </flux:timeline.item>
            @endunless
        </flux:timeline>
    @else
        @unless ($game->is_complete)
            <flux:callout icon="clock">
                <flux:callout.heading>No highlights recorded</flux:callout.heading>
                <x-slot name="actions">
                    <flux:button variant="primary" href="/games/{{ $game->id }}/edit" wire:navigate>
                        Continue Match
                    </flux:button>
                </x-slot>
            </flux:callout>
        @else
            <flux:callout icon="clock">
                <flux:callout.heading>No highlights recorded</flux:callout.heading>
            </flux:callout>
        @endunless
    @endif

    <flux:separator text="Actions" variant="subtle" class="my-9" />

    <flux:modal.trigger name="delete-match">
        <flux:button icon="trash">Delete Match</flux:button>
    </flux:modal.trigger>

    <flux:modal name="delete-match" class="min-w-[22rem]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Delete match?</flux:heading>
                <flux:text variant="strong" color="green" class="mt-2">
                    This action cannot be reversed
                </flux:text>
                <flux:text class="mt-2">
                    Are you sure you want to delete this match?
                </flux:text>
            </div>
            <div class="flex gap-2">
                <flux:spacer />
                <flux:modal.close>
                    <flux:button variant="ghost">Cancel</flux:button>
                </flux:modal.close>
                <flux:button type="submit" variant="danger" wire:click="delete">Confirm Delete</flux:button>
            </div>
        </div>
    </flux:modal>
</div>
