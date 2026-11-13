<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('game_events', function (Blueprint $table) {
            $table->foreignId('secondary_player_id')
                ->after('player_id')
                ->nullable()
                ->constrained('players', 'id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('game_events', function (Blueprint $table) {
            $table->dropConstrainedForeignId('secondary_player_id');
        });
    }
};
