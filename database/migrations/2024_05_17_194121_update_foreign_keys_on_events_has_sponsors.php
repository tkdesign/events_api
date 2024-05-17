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
        Schema::table('events_has_sponsors', function (Blueprint $table) {
            $table->dropForeign(['event_id']);
            $table->dropForeign(['sponsor_id']);
            $table->foreign('event_id')->references('event_id')->on('events')->onDelete('cascade');
            $table->foreign('sponsor_id')->references('sponsor_id')->on('sponsors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events_has_sponsors', function (Blueprint $table) {
            $table->dropForeign(['event_id']);
            $table->dropForeign(['sponsor_id']);
            $table->foreign('event_id')->references('event_id')->on('events');
            $table->foreign('sponsor_id')->references('sponsor_id')->on('sponsors');
        });
    }
};
