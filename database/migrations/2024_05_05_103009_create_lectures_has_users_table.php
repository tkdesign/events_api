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
        Schema::create('lectures_has_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lecture_id')->constrained('lectures', 'lecture_id');
            $table->foreignId('user_id')->constrained('users', 'id');
            $table->tinyInteger('visible')->nullable()->default(1);
            $table->integer('position')->nullable()->default(1);
            $table->timestamps();
            $table->index('lecture_id');
            $table->index('user_id');
            $table->index('position');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lectures_has_users');
    }
};
