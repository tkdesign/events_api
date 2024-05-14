<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/*
-- -----------------------------------------------------
-- Table `events_backend_db`.`events`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `events_backend_db`.`events` (
  `event_id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL,
  `desc_short` VARCHAR(255) NULL,
  `desc` TEXT NULL,
  `year` INT NOT NULL,
  `start_date` DATE NULL,
  `end_date` DATE NULL,
  `image` VARCHAR(255) NULL,
  `thumbnail` VARCHAR(255) NULL,
  `is_current` TINYINT NULL,
  `location` VARCHAR(255) NULL,
  `place` VARCHAR(255) NULL,
  `address` VARCHAR(255) NULL,
  `created_at` TIMESTAMP NULL DEFAULT NOW(),
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`event_id`),
  INDEX `events_created_at_idx` (`created_at` ASC) VISIBLE,
  UNIQUE INDEX `events_year_idx` (`year` ASC) VISIBLE)
ENGINE = InnoDB;
*/

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id('event_id');
            $table->string('title', 255);
            $table->string('desc_short', 255)->nullable();
            $table->text('desc')->nullable();
            $table->integer('year')->unique();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('image', 255)->nullable();
            $table->string('thumbnail', 255)->nullable();
            $table->tinyInteger('is_current')->nullable();
            $table->string('location', 255)->nullable();
            $table->string('place', 255)->nullable();
            $table->string('address', 255)->nullable();
            $table->timestamps();
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
