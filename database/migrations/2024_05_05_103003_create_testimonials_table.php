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
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id('testimonial_id');
            $table->foreignId('user_id')->constrained('users', 'id');
            $table->foreignId('event_id')->constrained('events', 'event_id');
            $table->text('desc')->nullable();
            $table->string('image')->nullable();
            $table->string('thumbnail')->nullable();
            $table->integer('rating')->nullable();
            $table->tinyInteger('visible')->default(1);
            $table->integer('position')->default(1);
            $table->timestamps();
            $table->index('user_id');
            $table->index('event_id');
            $table->index('position');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};
