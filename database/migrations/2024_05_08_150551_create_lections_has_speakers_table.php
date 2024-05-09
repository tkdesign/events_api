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
        Schema::create('lections_has_speakers', function (Blueprint $table) {
            $table->foreignId("lection_id");
            $table->foreignId("speaker_id");
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
        Schema::dropIfExists('lections_has_speakers');
    }
};
