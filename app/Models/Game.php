<?php

namespace App\Models;

use App\Enums\GameEventType;
use Database\Factories\GameFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable('home_team_id', 'away_team_id')]
class Game extends Model
{
    /** @use HasFactory<GameFactory> */
    use HasFactory;

    /**
     * @return BelongsTo<Team, $this>
     */
    public function homeTeam(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'home_team_id');
    }

    /**
     * @return BelongsTo<Team, $this>
     */
    public function awayTeam(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'away_team_id');
    }

    /**
     * @return HasMany<GameEvent, $this>
     */
    public function events(): HasMany
    {
        return $this->hasMany(GameEvent::class);
    }

    /**
     * @return HasMany<GameEvent, $this>
     */
    public function goals(): HasMany
    {
        return $this->hasMany(GameEvent::class)
            ->where('type', GameEventType::Goal->value);
    }

    /**
     * @return HasMany<GameEvent, $this>
     */
    public function ownGoals(): HasMany
    {
        return $this->hasMany(GameEvent::class)
            ->where('type', GameEventType::OwnGoal->value);
    }

    /**
     * @return BelongsTo<League, $this>
     */
    public function league(): BelongsTo
    {
        return $this->belongsTo(League::class);
    }

    /**
     * @return Attribute<int, never>
     */
    protected function homeScore(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => $this->goals->filter(fn ($goal) => $goal->team_id === $attributes['home_team_id'])->count()
                + $this->ownGoals->filter(fn ($own) => $own->team_id === $attributes['away_team_id'])->count()
        );
    }

    /**
     * @return Attribute<int, never>
     */
    protected function awayScore(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => $this->goals->filter(fn ($goal) => $goal->team_id === $attributes['away_team_id'])->count()
                + $this->ownGoals->filter(fn ($own) => $own->team_id === $attributes['home_team_id'])->count()
        );
    }
}
