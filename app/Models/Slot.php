<?php

namespace App\Models;

use App\Casts\TimeCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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

class Slot extends Model
{
    use HasFactory;

    protected $table = 'slots';

    protected $primaryKey = 'slot_id';

    protected $fillable = [
        'schedule_id',
        'stage_id',
        'lection_id',
        'day',
        'start_time',
        'end_time',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'day' => 'date',
        'start_time' => TimeCast::class,
        'end_time' => TimeCast::class,
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function lection()
    {
        return $this->belongsTo(Lection::class, 'lection_id', 'lection_id');
    }
}
