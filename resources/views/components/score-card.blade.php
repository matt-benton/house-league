<div class="grid grid-cols-[min-content_1fr_1fr]">
    <div class="row-span-2 flex items-center w-16 py-4">
        @unless ($match->is_complete)
            <flux:badge color="red" variant="solid" size="sm">Live</flux:badge>
        @else
            <flux:badge size="sm">FT</flux:badge>
        @endunless
    </div>
    <div class="py-4 space-y-2">
        @if ($match->is_complete && $homeScore > $awayScore)
            <flux:text variant="strong">{{ $match->homeTeam->abbreviation }}</flux:text>
            <flux:text>{{ $match->awayTeam->abbreviation }}</flux:text>
        @elseif ($match->is_complete && $homeScore < $awayScore)
            <flux:text>{{ $match->homeTeam->abbreviation }}</flux:text>
            <flux:text variant="strong">{{ $match->awayTeam->abbreviation }}</flux:text>
        @else
            <flux:text>{{ $match->homeTeam->abbreviation }}</flux:text>
            <flux:text>{{ $match->awayTeam->abbreviation }}</flux:text>
        @endif
    </div>
    <div class="text-right py-4 space-y-2">
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
