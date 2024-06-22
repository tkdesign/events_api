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
        Schema::disableForeignKeyConstraints();
        Schema::create('articles', function (Blueprint $table) {
            $table->id('article_id');
            $table->foreignId('menu_item_id')->nullable()->constrained('menu_items', 'menu_item_id');
            $table->string('title', 255)->nullable();
            $table->string('short_desc', 255)->nullable();
            $table->text('desc')->nullable();
            $table->timestamps();
            $table->index('menu_item_id');
            $table->index('created_at');
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
