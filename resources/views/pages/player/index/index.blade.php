<div class="mx-auto">
    <flux:heading size="lg" class="mb-3">Players</flux:heading>
        <flux:table :paginate="$this->players">
            <flux:table.columns>
                <flux:table.column
                    sortable
                    :sorted="$sortBy === 'name'"
                    :direction="$sortDirection"
                    wire:click="setSortBy('name')"
                    sticky
                    class="bg-zinc-800"
                >
                    Name
                </flux:table.column>
                <flux:table.column
                    sortable
                    :sorted="$sortBy === 'team_name'"
                    :direction="$sortDirection"
                    wire:click="setSortBy('team_name')"
                >
                    Team
                </flux:table.column>
                <flux:table.column
                    sortable
                    :sorted="$sortBy === 'goals_count'"
                    :direction="$sortDirection"
                    wire:click="setSortBy('goals_count')"
                >
                    Goals
                </flux:table.column>
                <flux:table.column
                    sortable
                    :sorted="$sortBy === 'saves_count'"
                    :direction="$sortDirection"
                    wire:click="setSortBy('saves_count')"
                >
                    Saves
                </flux:table.column>
                <flux:table.column
                    sortable
                    :sorted="$sortBy === 'yellow_cards_count'"
                    :direction="$sortDirection"
                    wire:click="setSortBy('yellow_cards_count')"
                >
                    Yellow Cards
                </flux:table.column>
                <flux:table.column
                    sortable
                    :sorted="$sortBy === 'red_cards_count'"
                    :direction="$sortDirection"
                    wire:click="setSortBy('red_cards_count')"
                >
                    Red Cards
                </flux:table.column>
            </flux:table.columns>

            @foreach ($this->players as $player)
                <flux:table.rows wire:key="$player->id">
                    <flux:table.row>
                        <flux:table.cell sticky class="bg-zinc-800">
                            <flux:link variant="ghost" href="/players/{{ $player->id }}" wire:navigate>
                                {{ $player->name }}
                            </flux:link>
                        </flux:table.cell>
                        <flux:table.cell>{{ $player->team_name }}</flux:table.cell>
                        <flux:table.cell>{{ $player->goals_count }}</flux:table.cell>
                        <flux:table.cell>{{ $player->saves_count }}</flux:table.cell>
                        <flux:table.cell>{{ $player->yellow_cards_count }}</flux:table.cell>
                        <flux:table.cell>{{ $player->red_cards_count }}</flux:table.cell>
                    </flux:table.row>
                </flux:table.rows>
            @endforeach
        </flux:table>
    <flux:button href="/players/create" class="mt-6 float-end" variant="primary" icon="user" wire:navigate>New Player</flux:button>
</div>
