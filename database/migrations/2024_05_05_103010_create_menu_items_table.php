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
        Schema::create('menu_items', function (Blueprint $table) {
            $table->id('menu_item_id');
            $table->string('name', 45)->nullable();
            $table->string('title', 45);
            $table->string('page_title', 255)->nullable();
            $table->string('path', 255);
            $table->string('component',45);
            $table->tinyInteger('visible')->nullable()->default(1);
            $table->integer('position')->nullable()->default(1);
            $table->integer('role')->nullable()->default(1);
            $table->tinyInteger('is_article')->nullable();
            $table->timestamps();
            $table->index(['role', 'position']);
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_items');
    }
};
