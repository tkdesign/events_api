<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('articles', function (Blueprint $table) {
            $table->id('article_id');
            $table->foreignId('menu_item_id')->nullable()->constrained('menu_items', 'menu_item_id');
            $table->string('title', 255)->nullable();
            $table->string('short_desc', 255)->nullable();
            $table->text('desc')->nullable();
            $table->timestamps();
            $table->index('menu_item_id');
            $table->index('created_at');
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
