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
        Schema::create('events', function (Blueprint $table) {
            $table->id('event_id');
            $table->string('title', 255);
            $table->string('desc_short', 255)->nullable();
            $table->text('desc')->nullable();
            $table->integer('year')->unique();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('image', 255)->nullable();
            $table->string('thumbnail', 255)->nullable();
            $table->tinyInteger('is_current')->nullable();
            $table->string('location', 255)->nullable();
            $table->string('place', 255)->nullable();
            $table->string('address', 255)->nullable();
            $table->timestamps();
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
