<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/*
-- -----------------------------------------------------
-- Table `events_backend_db`.`speakers`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `events_backend_db`.`speakers` (
  `speaker_id` INT NOT NULL AUTO_INCREMENT,
  `titul` VARCHAR(45) NULL,
  `first_name` VARCHAR(255) NOT NULL,
  `last_name` VARCHAR(255) NULL,
  `company` VARCHAR(255) NULL,
  `occupation` VARCHAR(255) NULL,
  `short_desc` VARCHAR(255) NULL,
  `desc` TEXT NULL,
  `email` VARCHAR(255) NOT NULL,
  `phone` VARCHAR(45) NULL,
  `facebook` VARCHAR(255) NULL,
  `instagram` VARCHAR(255) NULL,
  `linkedin` VARCHAR(255) NULL,
  `image` VARCHAR(255) NULL,
  `thumbnail` VARCHAR(255) NULL,
  `created_at` TIMESTAMP NULL DEFAULT NOW(),
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`speaker_id`),
  UNIQUE INDEX `speakers_email_idx` (`email` ASC) VISIBLE,
  INDEX `speakers_created_at_idx` (`created_at` ASC) VISIBLE)
ENGINE = InnoDB;
*/

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('speakers', function (Blueprint $table) {
            $table->id('speaker_id');
            $table->string('titul', 45)->nullable();
            $table->string('first_name', 255);
            $table->string('last_name', 255)->nullable();
            $table->string('company', 255)->nullable();
            $table->string('occupation', 255)->nullable();
            $table->string('short_desc', 255)->nullable();
            $table->text('desc')->nullable();
            $table->string('email', 255)->unique();
            $table->string('phone', 45)->nullable();
            $table->string('facebook', 255)->nullable();
            $table->string('instagram', 255)->nullable();
            $table->string('linkedin', 255)->nullable();
            $table->string('image', 255)->nullable();
            $table->string('thumbnail', 255)->nullable();
            $table->timestamps();
            $table->index('created_at');
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
