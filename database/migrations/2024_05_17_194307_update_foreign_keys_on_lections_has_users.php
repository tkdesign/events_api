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
        Schema::table('lections_has_users', function (Blueprint $table) {
            $table->dropForeign(['lection_id']);
            $table->dropForeign(['user_id']);
            $table->foreign('lection_id')->references('lection_id')->on('lections')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lections_has_users', function (Blueprint $table) {
            $table->dropForeign(['lection_id']);
            $table->dropForeign(['user_id']);
            $table->foreign('lection_id')->references('lection_id')->on('lections');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }
};
