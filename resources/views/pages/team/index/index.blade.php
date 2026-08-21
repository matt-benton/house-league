<div class="max-w-lg mx-auto">
    <flux:heading size="lg" class="mb-3">Teams</flux:heading>
        <flux:table :paginate="$this->teams">
            <flux:table.columns>
                <flux:table.column
                    sortable
                    :sorted="$sortBy === 'name'"
                    :direction="$sortDirection"
                    wire:click="setSortBy('name')"
                    sticky
                    class="bg-white dark:bg-zinc-800"
                >
                    Name
                </flux:table.column>
                <flux:table.column
                    sortable
                    :sorted="$sortBy === 'wins'"
                    :direction="$sortDirection"
                    wire:click="setSortBy('wins')"
                    align="end"
                >
                    Wins
                </flux:table.column>
                <flux:table.column
                    sortable
                    :sorted="$sortBy === 'losses'"
                    :direction="$sortDirection"
                    wire:click="setSortBy('losses')"
                    align="end"
                >
                    Losses
                </flux:table.column>
                <flux:table.column
                    sortable
                    :sorted="$sortBy === 'draws'"
                    :direction="$sortDirection"
                    wire:click="setSortBy('draws')"
                    align="end"
                >
                    Draws
                </flux:table.column>
            </flux:table.columns>

            @foreach ($this->teams as $team)
                <flux:table.rows wire:key="$team->id">
                    <flux:table.row>
                        <flux:table.cell sticky class="bg-white dark:bg-zinc-800">
                            <flux:link variant="ghost" href="/teams/{{ $team->id }}" wire:navigate>
                                {{ $team->name }}
                            </flux:link>
                        </flux:table.cell>
                        <flux:table.cell align="end">{{ $team->wins }}</flux:table.cell>
                        <flux:table.cell align="end">{{ $team->losses }}</flux:table.cell>
                        <flux:table.cell align="end">{{ $team->draws }}</flux:table.cell>
                    </flux:table.row>
                </flux:table.rows>
            @endforeach
        </flux:table>
    <flux:button href="/teams/create" class="mt-6 float-end" variant="primary" icon="flag" wire:navigate>New Team</flux:button>
</div>
