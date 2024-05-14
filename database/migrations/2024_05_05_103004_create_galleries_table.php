<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/*
-- -----------------------------------------------------
-- Table `events_backend_db`.`galleries`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `events_backend_db`.`galleries` (
  `gallery_id` INT NOT NULL AUTO_INCREMENT,
  `event_id` INT NOT NULL,
  `title` VARCHAR(255) NOT NULL,
  `short_desc` VARCHAR(255) NULL,
  `desc` TEXT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NOW(),
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`gallery_id`),
  INDEX `fk_galleries_event_id_idx` (`event_id` ASC) INVISIBLE,
  CONSTRAINT `fk_gallery_event_id`
    FOREIGN KEY (`event_id`)
    REFERENCES `events_backend_db`.`events` (`event_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;
*/

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('galleries', function (Blueprint $table) {
            $table->id('gallery_id');
            $table->foreignId('event_id')->constrained('events', 'event_id');
            $table->string('title');
            $table->string('short_desc')->nullable();
            $table->text('desc')->nullable();
            $table->timestamps();
            $table->index('event_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galleries');
    }
};
