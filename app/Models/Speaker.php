<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/*
-- -----------------------------------------------------
-- Table `events_backend_db`.`speakers`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `events_backend_db`.`speakers` (
  `speaker_id` INT NOT NULL AUTO_INCREMENT,
  `titul` VARCHAR(45) NULL,
  `first_name` VARCHAR(255) NOT NULL,
  `last_name` VARCHAR(255) NULL,
  `company` VARCHAR(255) NULL,
  `occupation` VARCHAR(255) NULL,
  `short_desc` VARCHAR(255) NULL,
  `desc` TEXT NULL,
  `email` VARCHAR(255) NOT NULL,
  `phone` VARCHAR(45) NULL,
  `facebook` VARCHAR(255) NULL,
  `instagram` VARCHAR(255) NULL,
  `linkedin` VARCHAR(255) NULL,
  `image` VARCHAR(255) NULL,
  `thumbnail` VARCHAR(255) NULL,
  `created_at` TIMESTAMP NULL DEFAULT NOW(),
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`speaker_id`),
  UNIQUE INDEX `speakers_email_idx` (`email` ASC) VISIBLE,
  INDEX `speakers_created_at_idx` (`created_at` ASC) VISIBLE)
ENGINE = InnoDB;
*/

class Speaker extends Model
{
    use HasFactory;

    protected $table = 'speakers';

    protected $primaryKey = 'speaker_id';

    protected $fillable = [
        'titul',
        'first_name',
        'last_name',
        'company',
        'occupation',
        'short_desc',
        'desc',
        'email',
        'phone',
        'facebook',
        'instagram',
        'linkedin',
        'image',
        'thumbnail',
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
