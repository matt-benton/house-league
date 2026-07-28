<div class="grid grid-cols-[min-content_1fr_1fr]">
    <div class="row-span-2 flex items-center w-16">
        @unless ($match->is_complete)
            <flux:badge color="red" variant="solid" size="sm">Live</flux:badge>
        @else
            <flux:badge size="sm">FT</flux:badge>
        @endunless
    </div>
    <div class="space-y-2">
        @if ($match->is_complete && $homeScore > $awayScore)
            <div class="grid grid-cols-[48px_1fr] items-baseline">
                <flux:text variant="strong">{{ $match->homeTeam->abbreviation }}</flux:text>
                <flux:text size="sm" variant="subtle">{{ $match->homeTeam->record }}</flux:text>
            </div>
            <div class="grid grid-cols-[48px_1fr] items-baseline">
                <flux:text>{{ $match->awayTeam->abbreviation }}</flux:text>
                <flux:text size="sm" variant="subtle">{{ $match->awayTeam->record }}</flux:text>
            </div>
        @elseif ($match->is_complete && $homeScore < $awayScore)
            <div class="grid grid-cols-[48px_1fr] items-baseline">
                <flux:text>{{ $match->homeTeam->abbreviation }}</flux:text>
                <flux:text variant="subtle">{{ $match->homeTeam->record }}</flux:text>
            </div>
            <div class="grid grid-cols-[48px_1fr] items-baseline">
                <flux:text variant="strong">{{ $match->awayTeam->abbreviation }}</flux:text>
                <flux:text variant="subtle">{{ $match->awayTeam->record }}</flux:text>
            </div>
        @else
            <div class="grid grid-cols-[48px_1fr] items-baseline">
                <flux:text>{{ $match->homeTeam->abbreviation }}</flux:text>
                <flux:text variant="subtle">{{ $match->homeTeam->record }}</flux:text>
            </div>
            <div class="grid grid-cols-[48px_1fr] items-baseline">
                <flux:text>{{ $match->awayTeam->abbreviation }}</flux:text>
                <flux:text variant="subtle">{{ $match->awayTeam->record }}</flux:text>
            </div>
        @endif
    </div>
    <div class="text-right space-y-2">
        @if ($match->is_complete && $homeScore > $awayScore)
            <flux:text variant="strong">{{ $homeScore }}</flux:text>
            <flux:text>{{ $awayScore }}</flux:text>
        @elseif ($match->is_complete && $homeScore < $awayScore)
            <flux:text>{{ $homeScore }}</flux:text>
            <flux:text variant="strong">{{ $awayScore }}</flux:text>
        @else
            <flux:text>{{ $homeScore }}</flux:text>
            <flux:text>{{ $awayScore }}</flux:text>
        @endif

    </div>
</div>
