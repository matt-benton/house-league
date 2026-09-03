<?php

namespace App\Models;

use Database\Factories\LeagueFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable('name')]
class League extends Model
{
    /** @use HasFactory<LeagueFactory> */
    use HasFactory;

    use SoftDeletes;

    /**
     * @return HasMany<Team, $this>
     */
    public function teams(): HasMany
    {
        return $this->hasMany(Team::class);
    }

    /**
     * @return HasMany<Game, $this>
     */
    public function games(): HasMany
    {
        return $this->hasMany(Game::class);
    }
}
