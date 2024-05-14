<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/*
-- -----------------------------------------------------
-- Table `events_backend_db`.`curators`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `events_backend_db`.`curators` (
  `curators_id` INT NOT NULL AUTO_INCREMENT,
  `titul` VARCHAR(45) NULL,
  `first_name` VARCHAR(255) NOT NULL,
  `last_name` VARCHAR(255) NULL,
  `company` VARCHAR(255) NULL,
  `occupation` VARCHAR(255) NULL,
  `phone` VARCHAR(255) NULL,
  `email` VARCHAR(255) NULL,
  `photo_url` VARCHAR(255) NULL,
  `created_at` TIMESTAMP NULL DEFAULT NOW(),
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`curators_id`),
  INDEX `curators_created_at_idx` (`created_at` ASC) VISIBLE)
ENGINE = InnoDB;
*/

class Curator extends Model
{
    use HasFactory;

    protected $table = 'curators';

    protected $primaryKey = 'curators_id';

    protected $fillable = [
        'titul',
        'first_name',
        'last_name',
        'company',
        'occupation',
        'phone',
        'email',
        'photo_url',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function events()
    {
        return $this->belongsToMany(Event::class, 'events_has_curators', 'curator_id', 'event_id')
            ->withPivot('visible', 'position')
            ->withTimestamps();
    }
}
