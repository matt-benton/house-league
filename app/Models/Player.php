<?php

namespace App\Models;

use App\Models\Scopes\OrderByNameScope;
use Database\Factories\PlayerFactory;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

#[ScopedBy([OrderByNameScope::class])]
class Player extends Model
{
    /** @use HasFactory<PlayerFactory> */
    use HasFactory;

    use SoftDeletes;

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }
}
