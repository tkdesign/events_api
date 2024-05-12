<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/*
-- -----------------------------------------------------
-- Table `events_backend_db`.`sponsors`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `events_backend_db`.`sponsors` (
  `sponsor_id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `short_desc` VARCHAR(255) NULL,
  `desc` TEXT NULL,
  `logo` VARCHAR(255) NULL,
  `url` VARCHAR(255) NULL,
  `email` VARCHAR(255) NOT NULL,
  `phone` VARCHAR(255) NULL,
  `created_at` TIMESTAMP NULL DEFAULT NOW(),
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`sponsor_id`),
  UNIQUE INDEX `sponsors_name_idx` (`name` ASC) VISIBLE,
  INDEX `sponsors_created_at_idx` (`created_at` ASC) VISIBLE)
ENGINE = InnoDB;
*/

class Sponsor extends Model
{
    use HasFactory;

    protected $table = 'sponsors';

    protected $primaryKey = 'sponsor_id';

    protected $fillable = [
        'name',
        'short_desc',
        'desc',
        'logo',
        'url',
        'email',
        'phone'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function events()
    {
        return $this->belongsToMany(Event::class, 'events_has_sponsors', 'sponsor_id', 'event_id')
            ->withPivot('visible', 'position')
            ->withTimestamps();
    }
}
