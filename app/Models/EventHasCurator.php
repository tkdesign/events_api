<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/*
-- -----------------------------------------------------
-- Table `events_backend_db`.`events_has_curators`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `events_backend_db`.`events_has_curators` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `event_id` INT NOT NULL,
  `curator_id` INT NOT NULL,
  `visible` TINYINT NULL DEFAULT 1,
  `position` INT NULL DEFAULT 1,
  `created_at` TIMESTAMP NULL DEFAULT NOW(),
  `updated_at` TIMESTAMP NULL,
  INDEX `fk_events_has_curators_curator_id_idx` (`curator_id` ASC) INVISIBLE,
  INDEX `fk_events_has_curators_event_id_idx` (`event_id` ASC) VISIBLE,
  INDEX `events_has_curators_position_idx` (`position` ASC) VISIBLE,
  INDEX `events_has_curators_created_at_idx` (`created_at` ASC) VISIBLE,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_events_has_curators_event_id`
    FOREIGN KEY (`event_id`)
    REFERENCES `events_backend_db`.`events` (`event_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_events_has_curators_curator_id`
    FOREIGN KEY (`curator_id`)
    REFERENCES `events_backend_db`.`curators` (`curators_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;
*/

class EventHasCurator extends Model
{
    use HasFactory;

    protected $table = 'events_has_curators';

    protected $primaryKey = 'id';

    protected $fillable = [
        'event_id',
        'curator_id',
        'visible',
        'position',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
//        'visible' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function event()
    {
        return $this->hasOne(Event::class, 'event_id', 'event_id');
    }

    public function curator()
    {
        return $this->hasOne(Curator::class, 'curator_id', 'curator_id');
    }
}
