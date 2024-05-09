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
        Schema::create('speakers', function (Blueprint $table) {
            $table->id("speaker_id");
            $table->string("titul")->nullable();
            $table->string("first_name");
            $table->string("last_name")->nullable();
            $table->string("company")->nullable();
            $table->string("occupation")->nullable();
            $table->string("short_desc")->nullable();
            $table->text("desc")->nullable();
            $table->string("email");
            $table->string("phone")->nullable();
            $table->string("facebook")->nullable();
            $table->string("instagram")->nullable();
            $table->string("linkedin")->nullable();
            $table->string("image")->nullable();
            $table->string("thumbnail")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('speakers');
    }
};
