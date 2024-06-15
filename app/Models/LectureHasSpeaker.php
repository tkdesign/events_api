<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/*
-- -----------------------------------------------------
-- Table `events_backend_db`.`lectures_has_speakers`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `events_backend_db`.`lectures_has_speakers` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `lecture_id` INT NOT NULL,
  `speaker_id` INT NOT NULL,
  `visible` TINYINT NULL DEFAULT 1,
  `position` INT NULL DEFAULT 1,
  `created_at` TIMESTAMP NULL DEFAULT NOW(),
  `updated_at` TIMESTAMP NULL,
  INDEX `fk_lectures_has_speakers_speaker_id_idx` (`speaker_id` ASC) VISIBLE,
  INDEX `fk_lectures_has_speakers_lecture_id_idx` (`lecture_id` ASC) VISIBLE,
  INDEX `lectures_has_speakers_position_idx` (`position` ASC) VISIBLE,
  INDEX `lectures_has_speakers_created_at_idx` (`created_at` ASC) VISIBLE,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_lectures_has_speakers_lecture_id`
    FOREIGN KEY (`lecture_id`)
    REFERENCES `events_backend_db`.`lectures` (`lecture_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_lectures_has_speakers_speaker_id`
    FOREIGN KEY (`speaker_id`)
    REFERENCES `events_backend_db`.`speakers` (`speaker_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;
*/

class LectureHasSpeaker extends Model
{
    use HasFactory;

    protected $table = 'lectures_has_speakers';

    protected $primaryKey = 'id';

    protected $fillable = [
        'lecture_id',
        'speaker_id',
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

    public function speaker()
    {
        return $this->hasOne(Speaker::class, 'speaker_id', 'speaker_id');
    }
}
