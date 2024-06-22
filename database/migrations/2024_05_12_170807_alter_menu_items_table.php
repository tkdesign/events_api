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
        Schema::table('menu_items', function (Blueprint $table) {
            //
            $table->tinyInteger('is_top_menu_item')->nullable()->default(1);
            $table->tinyInteger('is_bottom_menu_item')->nullable()->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('menu_items', function (Blueprint $table) {
            //
            $table->dropColumn(['is_top_menu_item', 'is_bottom_menu_item']);
        });
    }
};
