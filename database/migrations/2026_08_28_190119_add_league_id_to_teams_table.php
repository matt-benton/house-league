<?php

use App\Models\League;
use App\Models\Team;
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
        // add the column
        Schema::table('teams', function (Blueprint $table) {
            $table->foreignIdFor(League::class)->nullable();
        });

        // assign all teams to default league
        $league = League::first();
        Team::query()->withTrashed()->update(['league_id' => $league->id]);

        // make the column nullable and add the foreign constraint
        Schema::table('teams', function (Blueprint $table) {
            $table->integer('league_id')->change();

            $table->foreign('league_id')->references('id')->on('leagues');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('teams', function (Blueprint $table) {
            $table->dropConstrainedForeignIdFor(League::class);
        });
    }
};
