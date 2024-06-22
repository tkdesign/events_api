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
        Schema::create('banners', function (Blueprint $table) {
            $table->id('banner_id');
            $table->string('title', 255);
            $table->text('content')->nullable();
            $table->string('image')->nullable();
            $table->string('thumbnail')->nullable();
            $table->tinyInteger('visible')->nullable()->default(1);
            $table->integer('position')->nullable()->default(1);
            $table->string('color', 45)->nullable();
            $table->string('text_color', 45)->nullable();
            $table->foreignId('event_id')->constrained('events', 'event_id')->onDelete('cascade');
            $table->timestamps();
            $table->index('event_id');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};
