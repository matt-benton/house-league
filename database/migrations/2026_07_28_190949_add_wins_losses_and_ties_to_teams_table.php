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
        Schema::table('teams', function (Blueprint $table) {
            $table->unsignedSmallInteger('wins')->default(0)->after('name');
            $table->unsignedSmallInteger('losses')->default(0)->after('wins');
            $table->unsignedSmallInteger('draws')->default(0)->after('losses');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('teams', function (Blueprint $table) {
            $table->dropColumn('wins');
            $table->dropColumn('losses');
            $table->dropColumn('draws');
        });
    }
};
