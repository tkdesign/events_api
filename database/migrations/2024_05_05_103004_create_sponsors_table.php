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
        Schema::create('sponsors', function (Blueprint $table) {
            $table->id('sponsor_id');
            $table->string('name', 255)->unique();
            $table->string('short_desc', 255)->nullable();
            $table->text('desc')->nullable();
            $table->string('logo', 255)->nullable();
            $table->string('url', 255)->nullable();
            $table->string('email', 255);
            $table->string('phone', 255)->nullable();
            $table->timestamps();
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sponsors');
    }
};
