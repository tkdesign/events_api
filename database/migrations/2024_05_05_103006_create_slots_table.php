<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/*
-- -----------------------------------------------------
-- Table `events_backend_db`.`slots`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `events_backend_db`.`slots` (
  `slot_id` INT NOT NULL AUTO_INCREMENT,
  `schedule_id` INT NOT NULL,
  `stage_id` INT NOT NULL,
  `lection_id` INT NULL,
  `day` DATE NOT NULL,
  `start_time` TIME NOT NULL,
  `end_time` TIME NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NOW(),
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`slot_id`),
  INDEX `fk_slots_stage_id_idx` (`stage_id` ASC) VISIBLE,
  INDEX `fk_slots_lection_id_idx` (`lection_id` ASC) VISIBLE,
  INDEX `fk_slots_schedule_id_idx` (`schedule_id` ASC) VISIBLE,
  CONSTRAINT `fk_slots_stage_id`
    FOREIGN KEY (`stage_id`)
    REFERENCES `events_backend_db`.`stages` (`stage_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_slots_lection_id`
    FOREIGN KEY (`lection_id`)
    REFERENCES `events_backend_db`.`lections` (`lection_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_slots_schedule_id`
    FOREIGN KEY (`schedule_id`)
    REFERENCES `events_backend_db`.`schedules` (`schedule_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = '	';
*/

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('slots', function (Blueprint $table) {
            $table->id('slot_id');
            $table->foreignId('schedule_id')->constrained('schedules', 'schedule_id');
            $table->foreignId('stage_id')->constrained('stages', 'stage_id');
            $table->foreignId('lection_id')->nullable()->constrained('lections', 'lection_id');
            $table->date('day');
            $table->time('start_time');
            $table->time('end_time');
            $table->timestamp('created_at')->default(DB::raw('NOW()'));
            $table->timestamp('updated_at')->nullable();
            $table->index('stage_id');
            $table->index('lection_id');
            $table->index('schedule_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('slots');
    }
};
