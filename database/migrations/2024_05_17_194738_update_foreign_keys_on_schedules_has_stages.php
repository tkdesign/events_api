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
        Schema::table('schedules_has_stages', function (Blueprint $table) {
            $table->dropForeign(['schedule_id']);
            $table->dropForeign(['stage_id']);
            $table->foreign('schedule_id')->references('schedule_id')->on('schedules')->onDelete('cascade');
            $table->foreign('stage_id')->references('stage_id')->on('stages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('schedules_has_stages', function (Blueprint $table) {
            $table->dropForeign(['schedule_id']);
            $table->dropForeign(['stage_id']);
            $table->foreign('schedule_id')->references('schedule_id')->on('schedules');
            $table->foreign('stage_id')->references('stage_id')->on('stages');
        });
    }
};
