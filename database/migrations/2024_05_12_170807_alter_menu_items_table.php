<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('menu_items', function (Blueprint $table) {
            //
            $table->tinyInteger('is_top_menu_item')->nullable()->default(1);
            $table->tinyInteger('is_bottom_menu_item')->nullable()->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('menu_items', function (Blueprint $table) {
            //
            $table->dropColumn(['is_top_menu_item', 'is_bottom_menu_item']);
        });
    }
};
