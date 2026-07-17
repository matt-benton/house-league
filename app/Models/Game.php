<?php

namespace App\Models;

use Database\Factories\GameFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable('home_team_id', 'away_team_id')]
class Game extends Model
{
    /** @use HasFactory<GameFactory> */
    use HasFactory;
}
