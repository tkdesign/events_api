<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/*
-- -----------------------------------------------------
-- Table `events_backend_db`.`sponsors`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `events_backend_db`.`sponsors` (
  `sponsor_id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `short_desc` VARCHAR(255) NULL,
  `desc` TEXT NULL,
  `logo` VARCHAR(255) NULL,
  `url` VARCHAR(255) NULL,
  `email` VARCHAR(255) NOT NULL,
  `phone` VARCHAR(255) NULL,
  `created_at` TIMESTAMP NULL DEFAULT NOW(),
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`sponsor_id`),
  UNIQUE INDEX `sponsors_name_idx` (`name` ASC) VISIBLE,
  INDEX `sponsors_created_at_idx` (`created_at` ASC) VISIBLE)
ENGINE = InnoDB;
*/

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sponsors', function (Blueprint $table) {
            $table->id('sponsor_id');
            $table->string('name', 255)->unique();
            $table->string('short_desc', 255)->nullable();
            $table->text('desc')->nullable();
            $table->string('logo', 255)->nullable();
            $table->string('url', 255)->nullable();
            $table->string('email', 255);
            $table->string('phone', 255)->nullable();
            $table->timestamps();
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sponsors');
    }
};
