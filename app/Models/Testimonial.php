<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/*
-- -----------------------------------------------------
-- Table `events_backend_db`.`testimonials`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `events_backend_db`.`testimonials` (
  `testimonial_id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `event_id` INT NOT NULL,
  `desc` TEXT NULL,
  `image` VARCHAR(255) NULL,
  `thumbnail` VARCHAR(255) NULL,
  `rating` INT NULL,
  `visible` TINYINT NULL DEFAULT 1,
  `position` INT NULL DEFAULT 1,
  `created_at` TIMESTAMP NULL DEFAULT NOW(),
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`testimonial_id`),
  INDEX `fk_testimonials_user_id_idx` (`user_id` ASC) VISIBLE,
  INDEX `fk_testimonials_event_id_idx` (`event_id` ASC) VISIBLE,
  INDEX `testimonials_position_idx` (`position` ASC) VISIBLE,
  INDEX `testimonials_created_at_idx` (`created_at` ASC) VISIBLE,
  CONSTRAINT `fk_testimonials_user_id`
    FOREIGN KEY (`user_id`)
    REFERENCES `events_backend_db`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_testimonials_event_id`
    FOREIGN KEY (`event_id`)
    REFERENCES `events_backend_db`.`events` (`event_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;
*/

class Testimonial extends Model
{
    use HasFactory;

    protected $table = 'testimonials';

    protected $primaryKey = 'testimonial_id';

    protected $fillable = [
        'user_id',
        'event_id',
        'desc',
        'image',
        'thumbnail',
        'rating',
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
