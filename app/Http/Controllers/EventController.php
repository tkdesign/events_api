<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

/*
{
  "event_id": 1,
  "title": "Web Dev 2024",
  "desc_short": "The future of web development",
  "desc": "Web Dev 2024 is a conference that will focus on the future of web development. We will have speakers from all over the world talking about the latest technologies and trends in web development.",
  "year": 2024,
  "start_date": "2024-07-01",
  "end_date": "2024-07-02",
  "image": "https://images.unsplash.com/photo-1527686956515-6d2f2d1b4e1f",
  "thumbnail": "https://images.unsplash.com/photo-1527686956515-6d2f2d1b4e1f",
  "is_current": true,
  "location": "Nitra, Slovakia",
  "place": "UKF Nitra, Faculty of Natural Sciences",
  "address": "Trieda A.Hlinku, 1, 949 01 Nitra, Slovakia"
}
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

class EventController extends Controller
{
    //
    public function getCurrentEvent(): \Illuminate\Http\JsonResponse
    {
        $event = Event::where('is_current', true)->first();
        if (!$event) {
            return response()->json(['message' => 'Current event not found'], 404);
        }
        return response()->json($event);
    }
}
