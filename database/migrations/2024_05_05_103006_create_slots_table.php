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
        Schema::create('slots', function (Blueprint $table) {
            $table->id('slot_id');
            $table->foreignId('schedule_id')->constrained('schedules', 'schedule_id');
            $table->foreignId('stage_id')->constrained('stages', 'stage_id');
            $table->foreignId('lecture_id')->nullable()->constrained('lectures', 'lecture_id');
            $table->date('day');
            $table->time('start_time');
            $table->time('end_time');
            $table->timestamp('created_at')->default(DB::raw('NOW()'));
            $table->timestamp('updated_at')->nullable();
            $table->index('stage_id');
            $table->index('lecture_id');
            $table->index('schedule_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('slots');
    }
};
