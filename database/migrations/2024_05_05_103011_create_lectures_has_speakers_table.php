<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/*
-- -----------------------------------------------------
-- Table `events_backend_db`.`lectures_has_speakers`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `events_backend_db`.`lectures_has_speakers` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `lecture_id` INT NOT NULL,
  `speaker_id` INT NOT NULL,
  `visible` TINYINT NULL DEFAULT 1,
  `position` INT NULL DEFAULT 1,
  `created_at` TIMESTAMP NULL DEFAULT NOW(),
  `updated_at` TIMESTAMP NULL,
  INDEX `fk_lectures_has_speakers_speaker_id_idx` (`speaker_id` ASC) VISIBLE,
  INDEX `fk_lectures_has_speakers_lecture_id_idx` (`lecture_id` ASC) VISIBLE,
  INDEX `lectures_has_speakers_position_idx` (`position` ASC) VISIBLE,
  INDEX `lectures_has_speakers_created_at_idx` (`created_at` ASC) VISIBLE,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_lectures_has_speakers_lecture_id`
    FOREIGN KEY (`lecture_id`)
    REFERENCES `events_backend_db`.`lectures` (`lecture_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_lectures_has_speakers_speaker_id`
    FOREIGN KEY (`speaker_id`)
    REFERENCES `events_backend_db`.`speakers` (`speaker_id`)
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
        Schema::create('lectures_has_speakers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lecture_id')->constrained('lectures', 'lecture_id');
            $table->foreignId('speaker_id')->constrained('speakers', 'speaker_id');
            $table->tinyInteger('visible')->nullable()->default(1);
            $table->integer('position')->nullable()->default(1);
            $table->timestamps();
            $table->index('lecture_id');
            $table->index('speaker_id');
            $table->index('position');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lectures_has_speakers');
    }
};
