<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/*
-- -----------------------------------------------------
-- Table `events_backend_db`.`lections`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `events_backend_db`.`lections` (
  `lection_id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL,
  `short_desc` VARCHAR(255) NULL,
  `desc` TEXT NULL,
  `image` VARCHAR(255) NULL,
  `capacity` INT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NOW(),
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`lection_id`),
  INDEX `lections_created_at_idx` (`created_at` ASC) VISIBLE)
ENGINE = InnoDB;
*/

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lections', function (Blueprint $table) {
            $table->id('lection_id');
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
        Schema::dropIfExists('lections');
    }
};
