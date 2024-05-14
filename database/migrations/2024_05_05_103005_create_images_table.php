<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id('image_id');
            $table->foreignId('gallery_id')->constrained('galleries', 'gallery_id');
            $table->string('title');
            $table->string('image');
            $table->string('thumbnail');
            $table->tinyInteger('visible')->nullable()->default(1);
            $table->integer('position')->nullable()->default(1);
            $table->timestamps();
            $table->index('gallery_id');
            $table->index('position');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('images');
    }
};
