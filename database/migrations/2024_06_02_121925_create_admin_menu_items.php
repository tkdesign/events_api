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
        Schema::create('admin_menu_items', function (Blueprint $table) {
            $table->id();
            $table->string('name', 45)->nullable();
            $table->string('icon_class', 45)->nullable();
            $table->string('title', 45);
            $table->string('page_title', 255)->nullable();
            $table->string('path', 255);
            $table->string('router_link', 255);
            $table->string('component',45);
            $table->tinyInteger('visible')->nullable()->default(1);
            $table->integer('position')->nullable()->default(1);
            $table->timestamps();
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_menu_items');
    }
};
