<?php

namespace App\Models;
/*
-- -----------------------------------------------------
-- Table `events_backend_db`.`lections_has_users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `events_backend_db`.`lections_has_users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `lection_id` INT NOT NULL,
  `user_id` INT NOT NULL,
  `visible` TINYINT NULL DEFAULT 1,
  `position` INT NULL DEFAULT 1,
  `created_at` TIMESTAMP NULL DEFAULT NOW(),
  `updated_at` TIMESTAMP NULL,
  INDEX `fk_lections_has_users_user_id_idx` (`user_id` ASC) VISIBLE,
  INDEX `fk_lections_has_users_lection_id_idx` (`lection_id` ASC) VISIBLE,
  INDEX `lections_has_users_position_idx` (`position` ASC) VISIBLE,
  INDEX `lections_has_users_created_at_idx` (`position` ASC) VISIBLE,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_lections_has_users_lection_id`
    FOREIGN KEY (`lection_id`)
    REFERENCES `events_backend_db`.`lections` (`lection_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_lections_has_users_user_id`
    FOREIGN KEY (`user_id`)
    REFERENCES `events_backend_db`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;
*/

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LectionHasUser extends Model
{
    use HasFactory;

    protected $table = 'lections_has_users';

    protected $primaryKey = 'id';

    protected $fillable = [
        'lection_id',
        'user_id',
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
