<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/*
-- -----------------------------------------------------
-- Table `events_backend_db`.`galleries`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `events_backend_db`.`galleries` (
  `gallery_id` INT NOT NULL AUTO_INCREMENT,
  `event_id` INT NOT NULL,
  `title` VARCHAR(255) NOT NULL,
  `short_desc` VARCHAR(255) NULL,
  `desc` TEXT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NOW(),
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`gallery_id`),
  INDEX `fk_galleries_event_id_idx` (`event_id` ASC) INVISIBLE,
  CONSTRAINT `fk_gallery_event_id`
    FOREIGN KEY (`event_id`)
    REFERENCES `events_backend_db`.`events` (`event_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;
*/

class Gallery extends Model
{
    use HasFactory;

    protected $table = 'galleries';

    protected $primaryKey = 'gallery_id';

    protected $fillable = [
        'event_id',
        'title',
        'short_desc',
        'desc'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function images()
    {
        return $this->hasMany(GalleryImage::class, 'gallery_id', 'gallery_id');
    }

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id', 'event_id');
    }
}
