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
        Schema::table('events_has_curators', function (Blueprint $table) {
            $table->dropForeign(['event_id']);
            $table->dropForeign(['curator_id']);
            $table->foreign('event_id')->references('event_id')->on('events')->onDelete('cascade');
            $table->foreign('curator_id')->references('curator_id')->on('curators')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events_has_curators', function (Blueprint $table) {
            $table->dropForeign(['event_id']);
            $table->dropForeign(['curator_id']);
            $table->foreign('event_id')->references('event_id')->on('events');
            $table->foreign('curator_id')->references('curator_id')->on('curators');
        });
    }
};
