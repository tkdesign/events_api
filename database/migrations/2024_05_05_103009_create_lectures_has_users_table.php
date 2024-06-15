<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/*
-- -----------------------------------------------------
-- Table `events_backend_db`.`lectures_has_users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `events_backend_db`.`lectures_has_users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `lecture_id` INT NOT NULL,
  `user_id` INT NOT NULL,
  `visible` TINYINT NULL DEFAULT 1,
  `position` INT NULL DEFAULT 1,
  `created_at` TIMESTAMP NULL DEFAULT NOW(),
  `updated_at` TIMESTAMP NULL,
  INDEX `fk_lectures_has_users_user_id_idx` (`user_id` ASC) VISIBLE,
  INDEX `fk_lectures_has_users_lecture_id_idx` (`lecture_id` ASC) VISIBLE,
  INDEX `lectures_has_users_position_idx` (`position` ASC) VISIBLE,
  INDEX `lectures_has_users_created_at_idx` (`position` ASC) VISIBLE,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_lectures_has_users_lecture_id`
    FOREIGN KEY (`lecture_id`)
    REFERENCES `events_backend_db`.`lectures` (`lecture_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_lectures_has_users_user_id`
    FOREIGN KEY (`user_id`)
    REFERENCES `events_backend_db`.`users` (`id`)
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
        Schema::create('lectures_has_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lecture_id')->constrained('lectures', 'lecture_id');
            $table->foreignId('user_id')->constrained('users', 'id');
            $table->tinyInteger('visible')->nullable()->default(1);
            $table->integer('position')->nullable()->default(1);
            $table->timestamps();
            $table->index('lecture_id');
            $table->index('user_id');
            $table->index('position');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lectures_has_users');
    }
};
