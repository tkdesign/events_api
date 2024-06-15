<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/*
-- -----------------------------------------------------
-- Table `events_backend_db`.`lectures`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `events_backend_db`.`lectures` (
  `lecture_id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL,
  `short_desc` VARCHAR(255) NULL,
  `desc` TEXT NULL,
  `image` VARCHAR(255) NULL,
  `capacity` INT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NOW(),
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`lecture_id`),
  INDEX `lectures_created_at_idx` (`created_at` ASC) VISIBLE)
ENGINE = InnoDB;
*/

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lectures', function (Blueprint $table) {
            $table->id('lecture_id');
            $table->string('title', 255);
            $table->string('short_desc', 255)->nullable();
            $table->text('desc')->nullable();
            $table->string('image', 255)->nullable();
            $table->integer('capacity')->nullable();
            $table->timestamps();
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lectures');
    }
};
