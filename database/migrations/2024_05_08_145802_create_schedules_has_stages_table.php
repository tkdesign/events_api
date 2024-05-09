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
        Schema::create('schedule_has_stages', function (Blueprint $table) {
            $table->foreignId("schedule_id")->references("schedule_id")->on("schedules");
            $table->foreignId("stage_id")->references("stage_id")->on("stages");
            $table->tinyInteger("visible")->nullable();
            $table->integer("position")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedule_has_stages');
    }
};
