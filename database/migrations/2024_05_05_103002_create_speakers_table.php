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
        Schema::create('speakers', function (Blueprint $table) {
            $table->id('speaker_id');
            $table->string('titul', 45)->nullable();
            $table->string('first_name', 255);
            $table->string('last_name', 255)->nullable();
            $table->string('company', 255)->nullable();
            $table->string('occupation', 255)->nullable();
            $table->string('short_desc', 255)->nullable();
            $table->text('desc')->nullable();
            $table->string('email', 255)->unique();
            $table->string('phone', 45)->nullable();
            $table->string('facebook', 255)->nullable();
            $table->string('instagram', 255)->nullable();
            $table->string('linkedin', 255)->nullable();
            $table->string('image', 255)->nullable();
            $table->string('thumbnail', 255)->nullable();
            $table->timestamps();
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('speakers');
    }
};
