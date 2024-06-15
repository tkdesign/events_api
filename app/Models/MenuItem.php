<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/*
-- -----------------------------------------------------
-- Table `events_backend_db`.`menu_items`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `events_backend_db`.`menu_items` (
  `menu_item_id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  `title` VARCHAR(45) NOT NULL,
  `page_title` VARCHAR(255) NULL,
  `path` VARCHAR(255) NOT NULL,
  `component` VARCHAR(45) NOT NULL,
  `visible` TINYINT NULL DEFAULT 1,
  `position` INT NULL DEFAULT 1,
  `role` INT NULL DEFAULT 1,
  `is_article` TINYINT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NOW(),
  `updated_at` TIMESTAMP NULL,
  `is_top_menu_item` TINYINT NULL DEFAULT 1,
  `is_bottom_menu_item` TINYINT NULL DEFAULT 1,
  PRIMARY KEY (`menu_item_id`),
  INDEX `menu_items_role_position_idx` (`role` ASC, `position` ASC) VISIBLE,
  INDEX `menu_items_created_at_idx` (`created_at` ASC) VISIBLE)
ENGINE = InnoDB;
*/

class MenuItem extends Model
{
    use HasFactory;

    protected $table = 'menu_items';

    protected $primaryKey = 'menu_item_id';

    protected $fillable = [
        'name',
        'title',
        'page_title',
        'path',
        'component',
        'visible',
        'position',
        'role',
        'is_article',
        'is_top_menu_item',
        'is_bottom_menu_item',
    ];

    protected $casts = [
//        'visible' => 'boolean',
//        'is_article' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
//        'is_top_menu_item' => 'boolean',
//        'is_bottom_menu_item' => 'boolean',
    ];
}
