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
        Schema::table('lectures_has_users', function (Blueprint $table) {
            $table->dropForeign(['lecture_id']);
            $table->dropForeign(['user_id']);
            $table->foreign('lecture_id')->references('lecture_id')->on('lectures')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lectures_has_users', function (Blueprint $table) {
            $table->dropForeign(['lecture_id']);
            $table->dropForeign(['user_id']);
            $table->foreign('lecture_id')->references('lecture_id')->on('lectures');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }
};
