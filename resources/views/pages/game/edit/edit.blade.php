@use('App\Enums\GameEventType')
<div>
    <flux:badge color="red" class="mb-2" variant="solid">Live</flux:badge>
    <div class="flex justify-between mb-5">
        <flux:heading size="xl">{{ $game->homeTeam->name }}</flux:heading>
        <flux:heading size="xl">{{ $this->homeScore }}</flux:heading>
    </div>
    <div class="flex justify-between">
        <flux:heading size="xl">{{ $game->awayTeam->name }}</flux:heading>
        <flux:heading size="xl">{{ $this->awayScore }}</flux:heading>
    </div>

    <flux:separator text="Players" variant="subtle" class="mt-9 mb-9" />

    <div class="grid grid-cols-2 gap-4">
        <div class="space-y-2">
            <flux:text variant="subtle">{{ $game->homeTeam->name }}</flux:text>
            <ul class="space-y-1">
                @foreach ($game->homeTeam->roster->sortBy('position') as $player)
                    <li class="flex items-baseline gap-2">
                        <flux:text size="sm">#{{ $player->number }}</flux:text>
                        <flux:text size="lg" variant="strong">{{ $player->name }}</flux:text>
                        <flux:text variant="subtle">{{ $player->position }}</flux:text>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="space-y-2">
            <flux:text variant="subtle">{{ $game->awayTeam->name }}</flux:text>
            <ul class="space-y-2">
                @foreach ($game->awayTeam->roster->sortBy('position') as $player)
                    <li class="flex items-baseline gap-2">
                        <flux:text size="sm">#{{ $player->number }}</flux:text>
                        <flux:text size="lg" variant="strong">{{ $player->name }}</flux:text>
                        <flux:text variant="subtle">{{ $player->position }}</flux:text>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <flux:separator text="Highlights" variant="subtle" class="mt-9 mb-9" />

    <flux:timeline>
        @foreach ($game->events as $event)
            <flux:timeline.item>
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
                            <flux:text>Goal by {{ $event->player->name }} ({{ $event->player->team->abbreviation }})</flux:text>
                            @break

                        @case(GameEventType::YellowCard->value)
                            <flux:text>Yellow card given to {{ $event->player->name }} ({{ $event->player->team->abbreviation }})</flux:text>
                            @break

                        @case(GameEventType::RedCard->value)
                            <flux:text>Red card given to {{ $event->player->name }} ({{ $event->player->team->abbreviation }})</flux:text>
                            @break

                        @case(GameEventType::Save->value)
                            <flux:text>Save by {{ $event->player->name }} ({{ $event->player->team->abbreviation }})</flux:text>
                            @break
                    @endswitch
                </flux:timeline.content>
            </flux:timeline.item>
        @endforeach
    </flux:timeline>

    <flux:separator text="Controls" variant="subtle" class="mt-9 mb-9" />

    <div>
        <flux:dropdown>
            <flux:button icon:trailing="chevron-down">
                Goal
            </flux:button>

            <flux:menu>
                <flux:menu.submenu heading="{{ $game->homeTeam->abbreviation }}">
                    @foreach ($game->homeTeam->roster as $homePlayer)
                        <flux:menu.item wire:click="scoreGoal({{ $homePlayer->id }})">{{ $homePlayer->name }}</flux:menu.item>
                    @endforeach
                </flux:menu.submenu>

                <flux:menu.submenu heading="{{ $game->awayTeam->abbreviation }}">
                    @foreach ($game->awayTeam->roster as $awayPlayer)
                        <flux:menu.item wire:click="scoreGoal({{ $awayPlayer->id }})">{{ $awayPlayer->name }}</flux:menu.item>
                    @endforeach
                </flux:menu.submenu>
            </flux:menu>
        </flux:dropdown>

        <flux:dropdown>
            <flux:button icon:trailing="chevron-down">
                Yellow Card
            </flux:button>

            <flux:menu>
                <flux:menu.submenu heading="{{ $game->homeTeam->abbreviation }}">
                    @foreach ($game->homeTeam->roster as $homePlayer)
                        <flux:menu.item wire:click="giveYellowCard({{ $homePlayer->id }})">{{ $homePlayer->name }}</flux:menu.item>
                    @endforeach
                </flux:menu.submenu>

                <flux:menu.submenu heading="{{ $game->awayTeam->abbreviation }}">
                    @foreach ($game->awayTeam->roster as $awayPlayer)
                        <flux:menu.item wire:click="giveYellowCard({{ $awayPlayer->id }})">{{ $awayPlayer->name }}</flux:menu.item>
                    @endforeach
                </flux:menu.submenu>
            </flux:menu>
        </flux:dropdown>

        <flux:dropdown>
            <flux:button icon:trailing="chevron-down">
                Red Card
            </flux:button>

            <flux:menu>
                <flux:menu.submenu heading="{{ $game->homeTeam->abbreviation }}">
                    @foreach ($game->homeTeam->roster as $homePlayer)
                        <flux:menu.item wire:click="giveRedCard({{ $homePlayer->id }})">{{ $homePlayer->name }}</flux:menu.item>
                    @endforeach
                </flux:menu.submenu>

                <flux:menu.submenu heading="{{ $game->awayTeam->abbreviation }}">
                    @foreach ($game->awayTeam->roster as $awayPlayer)
                        <flux:menu.item wire:click="giveRedCard({{ $awayPlayer->id }})">{{ $awayPlayer->name }}</flux:menu.item>
                    @endforeach
                </flux:menu.submenu>
            </flux:menu>
        </flux:dropdown>

        <flux:dropdown>
            <flux:button icon:trailing="chevron-down">
                Save
            </flux:button>

            <flux:menu>
                <flux:menu.submenu heading="{{ $game->homeTeam->abbreviation }}">
                    @foreach ($game->homeTeam->roster as $homePlayer)
                        <flux:menu.item wire:click="recordSave({{ $homePlayer->id }})">{{ $homePlayer->name }}</flux:menu.item>
                    @endforeach
                </flux:menu.submenu>

                <flux:menu.submenu heading="{{ $game->awayTeam->abbreviation }}">
                    @foreach ($game->awayTeam->roster as $awayPlayer)
                        <flux:menu.item wire:click="recordSave({{ $awayPlayer->id }})">{{ $awayPlayer->name }}</flux:menu.item>
                    @endforeach
                </flux:menu.submenu>
            </flux:menu>
        </flux:dropdown>

        <flux:button>
            End Match
        </flux:button>
    </div>
</div>
