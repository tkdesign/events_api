<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/*
-- -----------------------------------------------------
-- Table `events_backend_db`.`lectures`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `events_backend_db`.`lectures` (
  `lecture_id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL,
  `short_desc` VARCHAR(255) NULL,
  `desc` TEXT NULL,
  `image` VARCHAR(255) NULL,
  `capacity` INT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NOW(),
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`lecture_id`),
  INDEX `lectures_created_at_idx` (`created_at` ASC) VISIBLE)
ENGINE = InnoDB;
*/

class Lecture extends Model
{
    use HasFactory;

    protected $table = 'lectures';

    protected $primaryKey = 'lecture_id';

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

    public function lectureHasUsers(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(LectureHasUser::class, 'lecture_id', 'lecture_id');
    }

    public function user(int $userId): ?User
    {
        return $this->users()->where('user_id', $userId)->first();
    }

    public function users(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(User::class, 'lectures_has_users', 'lecture_id', 'user_id');
    }

    public function slot(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Slot::class, 'lecture_id', 'lecture_id');
    }
}
