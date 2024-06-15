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
        Schema::table('lectures_has_speakers', function (Blueprint $table) {
            $table->dropForeign(['lecture_id']);
            $table->dropForeign(['speaker_id']);
            $table->foreign('lecture_id')->references('lecture_id')->on('lectures')->onDelete('cascade');
            $table->foreign('speaker_id')->references('speaker_id')->on('speakers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lectures_has_speakers', function (Blueprint $table) {
            $table->dropForeign(['lecture_id']);
            $table->dropForeign(['speaker_id']);
            $table->foreign('lecture_id')->references('lecture_id')->on('lectures');
            $table->foreign('speaker_id')->references('speaker_id')->on('speakers');
        });
    }
};
