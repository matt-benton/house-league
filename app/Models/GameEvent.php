<?php

namespace App\Models;

use Database\Factories\GameEventFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class GameEvent extends Model
{
    /** @use HasFactory<GameEventFactory> */
    use HasFactory;

    /**
     * @return BelongsTo<Player, $this>
     */
    public function player(): BelongsTo
    {
        return $this->belongsTo(Player::class);
    }

    /**
     * @return BelongsTo<Player, $this>
     */
    public function secondaryPlayer(): BelongsTo
    {
        return $this->belongsTo(Player::class, 'secondary_player_id');
    }

    /**
     * @return BelongsTo<Team, $this>
     */
    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    /**
     * @return HasOne<SecondaryEvent, $this>
     */
    public function secondaryEvent(): HasOne
    {
        return $this->hasOne(SecondaryEvent::class);
    }
}
