
<div>
    <flux:card>
        <form wire:submit="save" class="space-y-5">
            <flux:field>
                <flux:label>Home Team</flux:label>
                <flux:select wire:model="home_team_id" placeholder="Choose home team...">
                    @foreach ($teams as $team)
                        <flux:select.option value="{{ $team->id }}">{{ $team->abbreviation }} - {{ $team->name }}</flux:select.option>
                    @endforeach
                </flux:select>
                <flux:error name="home_team_id" />
            </flux:field>
            <flux:field>
                <flux:label>Away Team</flux:label>
                <flux:select wire:model="away_team_id" placeholder="Choose away team...">
                    @foreach ($teams as $team)
                        <flux:select.option value="{{ $team->id }}">{{ $team->abbreviation }} - {{ $team->name }}</flux:select.option>
                    @endforeach
                </flux:select>
                <flux:error name="away_team_id" />
            </flux:field>
            <div class="flex justify-end">
                <flux:button type="submit" variant="primary" icon="chevron-double-right">Start Match!</flux:button>
            </div>
        </form>
    </flux:card>
</div>
