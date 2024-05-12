<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/*
-- -----------------------------------------------------
-- Table `events_backend_db`.`lections`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `events_backend_db`.`lections` (
  `lection_id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL,
  `short_desc` VARCHAR(255) NULL,
  `desc` TEXT NULL,
  `image` VARCHAR(255) NULL,
  `capacity` INT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NOW(),
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`lection_id`),
  INDEX `lections_created_at_idx` (`created_at` ASC) VISIBLE)
ENGINE = InnoDB;
*/

class Lection extends Model
{
    use HasFactory;

    protected $table = 'lections';

    protected $primaryKey = 'lection_id';

    protected $fillable = [
        'title',
        'short_desc',
        'desc',
        'image',
        'capacity',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
