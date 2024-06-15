<?php

namespace App\Models;
/*
-- -----------------------------------------------------
-- Table `events_backend_db`.`lectures_has_users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `events_backend_db`.`lectures_has_users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `lecture_id` INT NOT NULL,
  `user_id` INT NOT NULL,
  `visible` TINYINT NULL DEFAULT 1,
  `position` INT NULL DEFAULT 1,
  `created_at` TIMESTAMP NULL DEFAULT NOW(),
  `updated_at` TIMESTAMP NULL,
  INDEX `fk_lectures_has_users_user_id_idx` (`user_id` ASC) VISIBLE,
  INDEX `fk_lectures_has_users_lecture_id_idx` (`lecture_id` ASC) VISIBLE,
  INDEX `lectures_has_users_position_idx` (`position` ASC) VISIBLE,
  INDEX `lectures_has_users_created_at_idx` (`position` ASC) VISIBLE,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_lectures_has_users_lecture_id`
    FOREIGN KEY (`lecture_id`)
    REFERENCES `events_backend_db`.`lectures` (`lecture_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_lectures_has_users_user_id`
    FOREIGN KEY (`user_id`)
    REFERENCES `events_backend_db`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;
*/

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LectureHasUser extends Model
{
    use HasFactory;

    protected $table = 'lectures_has_users';

    protected $primaryKey = 'id';

    protected $fillable = [
        'lecture_id',
        'user_id',
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

    public function lecture()
    {
        return $this->hasOne(Lecture::class, 'lecture_id', 'lecture_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function lectures()
    {
        return $this->hasMany(Lecture::class, 'lecture_id', 'lecture_id');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'id', 'user_id');
    }
}
