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
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id("testimonial_id");
            $table->foreignId("user_id");
            $table->foreignId("event_id");
            $table->string("title");
            $table->string("short_desc")->nullable();
            $table->text("desc")->nullable();
            $table->string("image")->nullable();
            $table->string("thumbnail")->nullable();
            $table->tinyInteger("visible")->nullable();
            $table->integer("position")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};
