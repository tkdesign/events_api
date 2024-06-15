<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/*
-- -----------------------------------------------------
-- Table `events_backend_db`.`images`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `events_backend_db`.`images` (
  `image_id` INT NOT NULL AUTO_INCREMENT,
  `gallery_id` INT NOT NULL,
  `title` VARCHAR(255) NOT NULL,
  `image` VARCHAR(255) NOT NULL,
  `thumbnail` VARCHAR(255) NOT NULL,
  `visible` TINYINT NULL DEFAULT 1,
  `position` INT NULL DEFAULT 1,
  `created_at` TIMESTAMP NULL DEFAULT NOW(),
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`image_id`),
  INDEX `fk_images_gallery_id_idx` (`gallery_id` ASC) VISIBLE,
  INDEX `images_position_idx` (`position` ASC) VISIBLE,
  INDEX `images_created_at_idx` (`created_at` ASC) VISIBLE,
  CONSTRAINT `fk_images_gallery_id`
    FOREIGN KEY (`gallery_id`)
    REFERENCES `events_backend_db`.`galleries` (`gallery_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;
*/

class Image extends Model
{
    use HasFactory;

    protected $table = 'images';

    protected $primaryKey = 'image_id';

    protected $fillable = [
        'gallery_id',
        'title',
        'image',
        'thumbnail',
        'visible',
        'position'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    protected $casts = [
//        'visible' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function gallery()
    {
        return $this->hasOne(Gallery::class, 'gallery_id', 'gallery_id');
    }
}
