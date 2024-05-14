<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/*
-- -----------------------------------------------------
-- Table `events_backend_db`.`stages`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `events_backend_db`.`stages` (
  `stage_id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL,
  `location` VARCHAR(255) NULL,
  `max_capacity` INT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NOW(),
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`stage_id`),
  INDEX `stages_title_idx` (`title` ASC) VISIBLE,
  INDEX `stages_created_at_idx` (`created_at` ASC) VISIBLE)
ENGINE = InnoDB;
*/

class Stage extends Model
{
    use HasFactory;

    protected $table = 'stages';

    protected $primaryKey = 'stage_id';

    protected $fillable = [
        'title',
        'location',
        'max_capacity'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
