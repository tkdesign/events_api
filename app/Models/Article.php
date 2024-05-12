<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/*
-- -----------------------------------------------------
-- Table `events_backend_db`.`articles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `events_backend_db`.`articles` (
  `article_id` INT NOT NULL AUTO_INCREMENT,
  `menu_item_id` INT NULL,
  `title` VARCHAR(255) NULL,
  `short_desc` VARCHAR(255) NULL,
  `desc` TEXT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NOW(),
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`article_id`),
  INDEX `fk_articles_menu_item_id_idx` (`menu_item_id` ASC) VISIBLE,
  INDEX `articles_menu_created_at_idx` (`created_at` ASC) VISIBLE,
  CONSTRAINT `fk_articles_menu_item_id`
    FOREIGN KEY (`menu_item_id`)
    REFERENCES `events_backend_db`.`menu_items` (`menu_item_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;
*/

class Article extends Model
{
    use HasFactory;

    protected $table = 'articles';

    protected $primaryKey = 'article_id';

    protected $fillable = [
        'menu_item_id',
        'title',
        'short_desc',
        'desc',
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function menuItem()
    {
        return $this->belongsTo(MenuItem::class, 'menu_item_id', 'menu_item_id');
    }
}
