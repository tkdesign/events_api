<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/*
-- -----------------------------------------------------
-- Table `events_backend_db`.`stages`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `events_backend_db`.`stages` (
  `stage_id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL,
  `location` VARCHAR(255) NULL,
  `max_capacity` INT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NOW(),
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`stage_id`),
  INDEX `stages_title_idx` (`title` ASC) VISIBLE,
  INDEX `stages_created_at_idx` (`created_at` ASC) VISIBLE)
ENGINE = InnoDB;
*/

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('stages', function (Blueprint $table) {
            $table->id('stage_id');
            $table->string('title', 255);
            $table->string('location', 255)->nullable();
            $table->integer('max_capacity')->nullable();
            $table->timestamps();
            $table->index('title');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stages');
    }
};
