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
        Schema::create('schedules_has_stages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('schedule_id')->constrained('schedules', 'schedule_id');
            $table->foreignId('stage_id')->constrained('stages', 'stage_id');
            $table->tinyInteger('visible')->nullable()->default(1);
            $table->integer('position')->nullable()->default(1);
            $table->timestamps();
            $table->index('schedule_id');
            $table->index('stage_id');
            $table->index('position');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules_has_stages');
    }
};
