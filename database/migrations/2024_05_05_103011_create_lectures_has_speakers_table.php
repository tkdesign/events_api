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
        Schema::create('lectures_has_speakers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lecture_id')->constrained('lectures', 'lecture_id');
            $table->foreignId('speaker_id')->constrained('speakers', 'speaker_id');
            $table->tinyInteger('visible')->nullable()->default(1);
            $table->integer('position')->nullable()->default(1);
            $table->timestamps();
            $table->index('lecture_id');
            $table->index('speaker_id');
            $table->index('position');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lectures_has_speakers');
    }
};
