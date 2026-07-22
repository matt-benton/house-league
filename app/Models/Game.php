<?php

namespace App\Models;

use App\Enums\GameEventType;
use Database\Factories\GameFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable('home_team_id', 'away_team_id')]
class Game extends Model
{
    /** @use HasFactory<GameFactory> */
    use HasFactory;

    public function homeTeam(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'home_team_id');
    }

    public function awayTeam(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'away_team_id');
    }

    public function events(): HasMany
    {
        return $this->hasMany(GameEvent::class);
    }

    public function goals(): HasMany
    {
        return $this->hasMany(GameEvent::class)
            ->where('type', GameEventType::Goal->value);
    }
}
