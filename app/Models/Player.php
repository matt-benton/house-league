<?php

namespace App\Models;

use App\Enums\GameEventType;
use App\Enums\Position;
use App\Models\Scopes\OrderByNameScope;
use Database\Factories\PlayerFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

#[ScopedBy([OrderByNameScope::class])]
#[Fillable('name', 'number', 'team_id', 'position')]
class Player extends Model
{
    /** @use HasFactory<PlayerFactory> */
    use HasFactory;

    use SoftDeletes;

    protected function casts(): array
    {
        return [
            'position' => Position::class,
        ];
    }

    /**
     * @return BelongsTo<Team, $this>
     */
    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    /**
     * @return HasMany<GameEvent, $this>
     */
    public function goals(): HasMany
    {
        return $this->hasMany(GameEvent::class)->where('type', GameEventType::Goal);
    }

    /**
     * @return HasMany<GameEvent, $this>
     */
    public function saves(): HasMany
    {
        return $this->hasMany(GameEvent::class)->where('type', GameEventType::Save);
    }

    /**
     * @return HasMany<GameEvent, $this>
     */
    public function yellowCards(): HasMany
    {
        return $this->hasMany(GameEvent::class)->where('type', GameEventType::YellowCard);
    }

    /**
     * @return HasMany<GameEvent, $this>
     */
    public function redCards(): HasMany
    {
        return $this->hasMany(GameEvent::class)->where('type', GameEventType::RedCard);
    }

    public function assists(): HasMany
    {
        return $this->hasMany(SecondaryEvent::class)->where('type', 'assist');
    }
}
