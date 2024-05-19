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
        Schema::table('lections_has_speakers', function (Blueprint $table) {
            $table->dropForeign(['lection_id']);
            $table->dropForeign(['speaker_id']);
            $table->foreign('lection_id')->references('lection_id')->on('lections')->onDelete('cascade');
            $table->foreign('speaker_id')->references('speaker_id')->on('speakers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lections_has_speakers', function (Blueprint $table) {
            $table->dropForeign(['lection_id']);
            $table->dropForeign(['speaker_id']);
            $table->foreign('lection_id')->references('lection_id')->on('lections');
            $table->foreign('speaker_id')->references('speaker_id')->on('speakers');
        });
    }
};
