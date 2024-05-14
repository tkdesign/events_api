<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/*
-- -----------------------------------------------------
-- Table `events_backend_db`.`schedules_has_stages`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `events_backend_db`.`schedules_has_stages` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `schedule_id` INT NOT NULL,
  `stage_id` INT NOT NULL,
  `visible` TINYINT NULL DEFAULT 1,
  `position` INT NULL DEFAULT 1,
  `created_at` TIMESTAMP NULL DEFAULT NOW(),
  `updated_at` TIMESTAMP NULL,
  INDEX `fk_schedules_has_stages_stage_id_idx` (`stage_id` ASC) VISIBLE,
  INDEX `fk_schedules_has_stages_schedule_id_idx` (`schedule_id` ASC) VISIBLE,
  INDEX `schedules_has_stages_position_idx` (`position` ASC) VISIBLE,
  INDEX `schedules_has_stages_created_at_idx` (`created_at` ASC) VISIBLE,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_schedules_has_stages_schedule_id`
    FOREIGN KEY (`schedule_id`)
    REFERENCES `events_backend_db`.`schedules` (`schedule_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_schedules_has_stages_stage_id`
    FOREIGN KEY (`stage_id`)
    REFERENCES `events_backend_db`.`stages` (`stage_id`)
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
        Schema::create('schedules_has_stages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('schedule_id')->constrained('schedules', 'schedule_id');
            $table->foreignId('stage_id')->constrained('stages', 'stage_id');
            $table->tinyInteger('visible')->nullable()->default(1);
            $table->integer('position')->nullable()->default(1);
            $table->timestamps();
            $table->index('schedule_id');
            $table->index('stage_id');
            $table->index('position');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules_has_stages');
    }
};
