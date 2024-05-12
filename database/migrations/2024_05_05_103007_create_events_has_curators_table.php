<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/*
-- -----------------------------------------------------
-- Table `events_backend_db`.`events_has_curators`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `events_backend_db`.`events_has_curators` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `event_id` INT NOT NULL,
  `curator_id` INT NOT NULL,
  `visible` TINYINT NULL DEFAULT 1,
  `position` INT NULL DEFAULT 1,
  `created_at` TIMESTAMP NULL DEFAULT NOW(),
  `updated_at` TIMESTAMP NULL,
  INDEX `fk_events_has_curators_curator_id_idx` (`curator_id` ASC) INVISIBLE,
  INDEX `fk_events_has_curators_event_id_idx` (`event_id` ASC) VISIBLE,
  INDEX `events_has_curators_position_idx` (`position` ASC) VISIBLE,
  INDEX `events_has_curators_created_at_idx` (`created_at` ASC) VISIBLE,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_events_has_curators_event_id`
    FOREIGN KEY (`event_id`)
    REFERENCES `events_backend_db`.`events` (`event_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_events_has_curators_curator_id`
    FOREIGN KEY (`curator_id`)
    REFERENCES `events_backend_db`.`curators` (`curators_id`)
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
        Schema::create('events_has_curators', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained('events', 'event_id');
            $table->foreignId('curator_id')->constrained('curators', 'curator_id');
            $table->tinyInteger('visible')->nullable()->default(1);
            $table->integer('position')->nullable()->default(1);
            $table->timestamps();
            $table->index('event_id');
            $table->index('curator_id');
            $table->index('position');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events_has_curators');
    }
};
