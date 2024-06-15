<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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

class Schedule extends Model
{
    use HasFactory;

    protected $table = 'schedules';

    protected $primaryKey = 'schedule_id';

    protected $fillable = [
        'schedule_id',
        'event_id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function stages() {
        return $this->hasMany(Stage::class, 'schedule_id', 'schedule_id');
    }

    public function event() {
        return $this->hasOne(Event::class, 'event_id', 'event_id');
    }
}
