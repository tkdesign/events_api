<?php

namespace App\Http\Controllers;

use App\Models\Curator;
use Illuminate\Http\Request;

/*
{
  "curators": [
    {
      "type": "subheader",
      "title": "Curators"
    },
    {
      "image": "https://cdn.vuetifyjs.com/images/lists/1.jpg",
      "title": "PAVOL KOLLAR",
      "company": "UKF",
      "role": "Organizer",
      "phone": "+421 596 355 32",
      "email": "pavel_kollar@ukf.sk"
    },
    {
      "type": "divider",
      "inset": true
    },
    {
      "image": "https://cdn.vuetifyjs.com/images/lists/4.jpg",
      "title": "INGRID KOLLAR",
      "company": "UKF",
      "role": "Planer",
      "phone": "+421 596 355 32",
      "email": "ingrid_kollar@ukf.sk"
    }
  ]
}
*/
/*
-- -----------------------------------------------------
-- Table `events_backend_db`.`curators`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `events_backend_db`.`curators` (
  `curators_id` INT NOT NULL AUTO_INCREMENT,
  `titul` VARCHAR(45) NULL,
  `first_name` VARCHAR(255) NOT NULL,
  `last_name` VARCHAR(255) NULL,
  `company` VARCHAR(255) NULL,
  `occupation` VARCHAR(255) NULL,
  `phone` VARCHAR(255) NULL,
  `email` VARCHAR(255) NULL,
  `photo_url` VARCHAR(255) NULL,
  `created_at` TIMESTAMP NULL DEFAULT NOW(),
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`curators_id`),
  INDEX `curators_created_at_idx` (`created_at` ASC) VISIBLE)
ENGINE = InnoDB;
*/
/*
-- -----------------------------------------------------
-- Table `events_backend_db`.`events`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `events_backend_db`.`events` (
  `event_id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL,
  `desc_short` VARCHAR(255) NULL,
  `desc` TEXT NULL,
  `year` INT NOT NULL,
  `start_date` DATE NULL,
  `end_date` DATE NULL,
  `image` VARCHAR(255) NULL,
  `thumbnail` VARCHAR(255) NULL,
  `is_current` TINYINT NULL,
  `location` VARCHAR(255) NULL,
  `place` VARCHAR(255) NULL,
  `address` VARCHAR(255) NULL,
  `created_at` TIMESTAMP NULL DEFAULT NOW(),
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`event_id`),
  INDEX `events_created_at_idx` (`created_at` ASC) VISIBLE,
  UNIQUE INDEX `events_year_idx` (`year` ASC) VISIBLE)
ENGINE = InnoDB;
*/
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
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_events_has_curators_curator_id`
    FOREIGN KEY (`curator_id`)
    REFERENCES `events_backend_db`.`curators` (`curators_id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;
*/

class ContactsController extends Controller
{
    //
    public function getCurators()
    {
        $curators = Curator::query()
            ->join('events_has_curators', 'curators.curator_id', '=', 'events_has_curators.curator_id')
            ->join('events', 'events.event_id', '=', 'events_has_curators.event_id')
            ->where('events.is_current', true)
            ->get();
        $curators_list = array();
        $curators_list[] = [
            'type' => 'subheader',
            'title' => 'Curators'
        ];
        $i = 0;
        foreach ($curators as $curator) {
            if ($i > 0) {
                $curators_list[] = [
                    'type' => 'divider',
                    'inset' => true
                ];
            }
            $curators_list[] = [
                'image' => $curator->photo_url,
                'title' => join(' ', array($curator->first_name, $curator->last_name)),
                'company' => $curator->company,
                'role' => $curator->occupation,
                'phone' => $curator->phone,
                'email' => $curator->email
            ];
            $i++;
        }
        $curators_data = ['curators' => $curators_list];
        return response()->json($curators_data);
    }
}
