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
        Schema::create('curators', function (Blueprint $table) {
            $table->id('curator_id');
            $table->string('titul', 45)->nullable();
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('company')->nullable();
            $table->string('occupation')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('photo_url')->nullable();
            $table->timestamps();
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('curators');
    }
};
