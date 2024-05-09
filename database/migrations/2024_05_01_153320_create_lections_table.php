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
        Schema::create('lections', function (Blueprint $table) {
            $table->id("lection_id");
            $table->string("title");
            $table->string("short_desc")->nullable();
            $table->text("desc")->nullable();
            $table->integer("capacity")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lections');
    }
};
