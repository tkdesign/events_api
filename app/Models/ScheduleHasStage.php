<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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

class ScheduleHasStage extends Model
{
    use HasFactory;

    protected $table = 'schedules_has_stages';

    protected $fillable = [
        'schedule_id',
        'stage_id',
        'visible',
        'position',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'visible' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
