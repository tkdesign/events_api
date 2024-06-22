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
        Schema::create('events_has_curators', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained('events', 'event_id');
            $table->foreignId('curator_id')->constrained('curators', 'curator_id');
            $table->tinyInteger('visible')->nullable()->default(1);
            $table->integer('position')->nullable()->default(1);
            $table->timestamps();
            $table->index('event_id');
            $table->index('curator_id');
            $table->index('position');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events_has_curators');
    }
};
