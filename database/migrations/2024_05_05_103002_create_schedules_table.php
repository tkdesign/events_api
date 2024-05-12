<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/*
-- -----------------------------------------------------
-- Table `events_backend_db`.`schedules`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `events_backend_db`.`schedules` (
  `schedule_id` INT NOT NULL AUTO_INCREMENT,
  `event_id` INT NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NOW(),
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`schedule_id`),
  INDEX `fk_schedules_event_id_idx` (`event_id` ASC) VISIBLE,
  INDEX `schedules_created_at_idx` (`created_at` ASC) INVISIBLE,
  CONSTRAINT `fk_schedules_event_id`
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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id('schedule_id');
            $table->foreignId('event_id')->constrained('events', 'event_id');
            $table->timestamps();
            $table->index('event_id');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
