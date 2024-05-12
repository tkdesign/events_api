<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/*
-- -----------------------------------------------------
-- Table `events_backend_db`.`events_has_sponsors`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `events_backend_db`.`events_has_sponsors` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `event_id` INT NOT NULL,
  `sponsor_id` INT NOT NULL,
  `visible` TINYINT NULL DEFAULT 1,
  `position` INT NULL DEFAULT 1,
  `created_at` TIMESTAMP NULL DEFAULT NOW(),
  `updated_at` TIMESTAMP NULL,
  INDEX `fk_events_has_sponsors_sponsor_id_idx` (`sponsor_id` ASC) VISIBLE,
  INDEX `fk_events_has_sponsors_event_id_idx` (`event_id` ASC) VISIBLE,
  INDEX `events_has_sponsors_position_idx` (`position` ASC) VISIBLE,
  INDEX `events_has_sponsors_created_at_idx` (`created_at` ASC) VISIBLE,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_events_has_sponsors_event_id`
    FOREIGN KEY (`event_id`)
    REFERENCES `events_backend_db`.`events` (`event_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_events_has_sponsors_sponsor_id`
    FOREIGN KEY (`sponsor_id`)
    REFERENCES `events_backend_db`.`sponsors` (`sponsor_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;
*/

class EventHasSponsor extends Model
{
    use HasFactory;

    protected $table = 'events_has_sponsors';

    protected $primaryKey = 'id';

    protected $fillable = [
        'event_id',
        'sponsor_id',
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

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id', 'event_id');
    }

    public function sponsor()
    {
        return $this->belongsTo(Sponsor::class, 'sponsor_id', 'sponsor_id');
    }

}
