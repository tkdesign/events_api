<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/*
-- -----------------------------------------------------
-- Table `events_backend_db`.`testimonials`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `events_backend_db`.`testimonials` (
  `testimonial_id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `event_id` INT NOT NULL,
  `desc` TEXT NULL,
  `image` VARCHAR(255) NULL,
  `thumbnail` VARCHAR(255) NULL,
  `rating` INT NULL,
  `visible` TINYINT NULL DEFAULT 1,
  `position` INT NULL DEFAULT 1,
  `created_at` TIMESTAMP NULL DEFAULT NOW(),
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`testimonial_id`),
  INDEX `fk_testimonials_user_id_idx` (`user_id` ASC) VISIBLE,
  INDEX `fk_testimonials_event_id_idx` (`event_id` ASC) VISIBLE,
  INDEX `testimonials_position_idx` (`position` ASC) VISIBLE,
  INDEX `testimonials_created_at_idx` (`created_at` ASC) VISIBLE,
  CONSTRAINT `fk_testimonials_user_id`
    FOREIGN KEY (`user_id`)
    REFERENCES `events_backend_db`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_testimonials_event_id`
    FOREIGN KEY (`event_id`)
    REFERENCES `events_backend_db`.`events` (`event_id`)
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
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id('testimonial_id');
            $table->foreignId('user_id')->constrained('users', 'id');
            $table->foreignId('event_id')->constrained('events', 'event_id');
            $table->text('desc')->nullable();
            $table->string('image')->nullable();
            $table->string('thumbnail')->nullable();
            $table->integer('rating')->nullable();
            $table->tinyInteger('visible')->default(1);
            $table->integer('position')->default(1);
            $table->timestamps();
            $table->index('user_id');
            $table->index('event_id');
            $table->index('position');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};
