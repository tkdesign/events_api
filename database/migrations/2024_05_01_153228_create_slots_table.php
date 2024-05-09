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
            $table->id("slot_id");
            $table->foreignId("schedule_id")->references("schedule_id")->on("schedules");
            $table->foreignId("stage_id")->references("stage_id")->on("stages");
            $table->foreignId("lection_id")->references("lection_id")->on("lections")->nullable();
            $table->date("day");
            $table->time("start_time");
            $table->time("end_time");
            $table->timestamps();
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
