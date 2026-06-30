<?php

namespace App\Models;

use App\Models\Scopes\OrderByNameScope;
use Database\Factories\TeamFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

#[ScopedBy([OrderByNameScope::class])]
#[Fillable('abbreviation', 'name')]
class Team extends Model
{
    /** @use HasFactory<TeamFactory> */
    use HasFactory;

    use SoftDeletes;

    /**
     * Get the user's first name.
     */
    protected function abbreviation(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => strtoupper($value),
        );
    }

    public function roster(): HasMany
    {
        return $this->hasMany(Player::class)->orderBy('position');
    }
}
