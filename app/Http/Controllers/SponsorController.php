<?php

namespace App\Http\Controllers;

use App\Models\Sponsor;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

/*
{
  "sponsors": [
    {
      "sponsor_id": 1,
      "name": "IBM",
      "short_desc": "IBM is a global technology and innovation company headquartered in Armonk, NY. It is the largest technology and consulting employer in the world, with more than 400,000 employees serving clients in 170 countries.",
      "desc": "IBM is a global technology and innovation company headquartered in Armonk, NY. It is the largest technology and consulting employer in the world, with more than 400,000 employees serving clients in 170 countries.",
      "logo": "https://upload.wikimedia.org/wikipedia/commons/thumb/5/51/IBM_logo.svg/1920px-IBM_logo.svg.png",
      "url": "https://www.ibm.com/",
      "email": "infoibm@us.ibm.com",
      "phone": "+1 914-499-7777"
    },
    {
      "sponsor_id": 2,
      "name": "Microsoft",
      "short_desc": "Microsoft is an American multinational technology company with headquarters in Redmond, Washington. It develops, manufactures, licenses, supports, and sells computer software, consumer electronics, personal computers, and related services.",
      "desc": "Microsoft is an American multinational technology company with headquarters in Redmond, Washington. It develops, manufactures, licenses, supports, and sells computer software, consumer electronics, personal computers, and related services.",
      "logo": "https://upload.wikimedia.org/wikipedia/commons/thumb/9/96/Microsoft_logo_%282012%29.svg/1920px-Microsoft_logo_%282012%29.svg.png",
      "url": "https://www.microsoft.com/",
      "email": "msft@microsoft.com",
      "phone": "+1 (425) 706-4400"
    },
    {
      "sponsor_id": 3,
      "name": "Google",
      "short_desc": "Google is an American multinational technology company that specializes in Internet-related services and products, which include online advertising technologies, search engine, cloud computing, software, and hardware.",
      "desc": "Google is an American multinational technology company that specializes in Internet-related services and products, which include online advertising technologies, search engine, cloud computing, software, and hardware.",
      "logo": "https://upload.wikimedia.org/wikipedia/commons/thumb/2/2f/Google_2015_logo.svg/1920px-Google_2015_logo.svg.png",
      "url": "https://www.google.com/",
      "email": "press@google.com",
      "phone": "+1 (650) 253-0000"
    }
  ]
}
*/
/*
-- -----------------------------------------------------
-- Table `events_backend_db`.`sponsors`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `events_backend_db`.`sponsors` (
  `sponsor_id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `short_desc` VARCHAR(255) NULL,
  `desc` TEXT NULL,
  `logo` VARCHAR(255) NULL,
  `url` VARCHAR(255) NULL,
  `email` VARCHAR(255) NOT NULL,
  `phone` VARCHAR(255) NULL,
  `created_at` TIMESTAMP NULL DEFAULT NOW(),
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`sponsor_id`),
  UNIQUE INDEX `sponsors_name_idx` (`name` ASC) VISIBLE,
  INDEX `sponsors_created_at_idx` (`created_at` ASC) VISIBLE)
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
-- Table `events_backend_db`.`events_has_sponsors`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `events_backend_db`.`events_has_sponsors` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `event_id` INT NOT NULL,
  `sponsor_id` INT NOT NULL,
  `visible` TINYINT NULL DEFAULT 1,
  `position` INT NULL DEFAULT 1,
  `created_at` TIMESTAMP NULL DEFAULT NOW(),
  `updated_at` TIMESTAMP NULL,
  INDEX `fk_events_has_sponsors_sponsor_id_idx` (`sponsor_id` ASC) VISIBLE,
  INDEX `fk_events_has_sponsors_event_id_idx` (`event_id` ASC) VISIBLE,
  INDEX `events_has_sponsors_position_idx` (`position` ASC) VISIBLE,
  INDEX `events_has_sponsors_created_at_idx` (`created_at` ASC) VISIBLE,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_events_has_sponsors_event_id`
    FOREIGN KEY (`event_id`)
    REFERENCES `events_backend_db`.`events` (`event_id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_events_has_sponsors_sponsor_id`
    FOREIGN KEY (`sponsor_id`)
    REFERENCES `events_backend_db`.`sponsors` (`sponsor_id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;
*/

class SponsorController extends Controller
{
    //
    public function getSponsors(): JsonResponse
    {
        $sponsors = Sponsor::query()
            ->join('events_has_sponsors', 'sponsors.sponsor_id', '=', 'events_has_sponsors.sponsor_id')
            ->join('events', 'events.event_id', '=', 'events_has_sponsors.event_id')
            ->where('events.is_current', true)
            ->get();
        $sponsors_data = [
            'sponsors' => $sponsors
        ];
        return response()->json($sponsors_data);
    }

    public function getSponsorsAdmin(Request $request): \Illuminate\Http\JsonResponse
    {
        /*
        page=1&itemsPerPage=10&search[name]=asdasd
        */
        $sponsors = Sponsor::query()
            ->where('name', 'like', '%' . $request->input('search.name', '') . '%')
            ->orderBy($request->get('sortBy', 'sponsor_id'), $request->get('sortOrder', 'asc'))
            ->paginate($request->get('itemsPerPage', 10), ['*'], 'page', $request->get('page', 1));
        return response()->json($sponsors);
    }

    public function getSponsorsAllAdmin(Request $request): \Illuminate\Http\JsonResponse
    {
        $sponsors = Sponsor::query()
            ->orderBy($request->get('sortBy', 'sponsor_id'), $request->get('sortOrder', 'asc'))
            ->get();
        return response()->json($sponsors);
    }

    public function getSponsorAdmin(int $id): \Illuminate\Http\JsonResponse
    {
        $sponsor = Sponsor::find($id);
        if (!$sponsor) {
            return response()->json(['status' => false, 'message' => 'Sponsor not found']);
        }
        return response()->json($sponsor);
    }

    public function updateSponsor(Request $request): \Illuminate\Http\JsonResponse
    {
        if (!$request->has('name') || !$request->has('email')) {
            return response()->json(['status' => false, 'message' => 'Missing required fields']);
        }
        if($request->has('sponsor_id') && $request->post('sponsor_id') > 0) {
            $images_folder = 'images/sponsors';
            $sponsor = Sponsor::find($request->post('sponsor_id'));
            if (!$sponsor) {
                return response()->json(['status' => false, 'message' => 'Sponsor not found']);
            }
            $sponsor->name = $request->post('name', '');
            $sponsor->short_desc = $request->post('short_desc', '');
            $sponsor->desc = $request->post('desc', '');
            if($request->hasFile('logo')) {
                if($sponsor->logo) {
                    Storage::delete(public_path($sponsor->logo));
                }
                $image = $request->file('logo');
                $imageName = time().'.'.$image->getClientOriginalExtension();
                $image->move(public_path($images_folder), $imageName);
                $sponsor->logo = "/$images_folder/".$imageName;
            }
            $sponsor->url = $request->post('url', '');
            $sponsor->email = $request->post('email', '');
            $sponsor->phone = $request->post('phone', '');
            $sponsor->save();
            return response()->json($sponsor);
        }
        return response()->json(['status' => false, 'message' => 'Sponsor not found']);
    }

    public function createSponsor(Request $request): \Illuminate\Http\JsonResponse
    {
        if (!$request->has('name') || !$request->has('email')) {
            return response()->json(['message' => 'Missing required fields'], 400);
        }
        $images_folder = 'images/sponsors';

        $sponsor = new Sponsor();
        $sponsor->name = $request->post('name', '');
        $sponsor->short_desc = $request->post('short_desc', '');
        $sponsor->desc = $request->post('desc', '');
        if($request->hasFile('logo')) {
            $image = $request->file('logo');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path($images_folder), $imageName);
            $sponsor->logo = "/$images_folder/".$imageName;
        }
        $sponsor->url = $request->post('url', '');
        $sponsor->email = $request->post('email', '');
        $sponsor->phone = $request->post('phone', '');

        $sponsor->save();

        return response()->json($sponsor);
    }

    public function deleteSponsor(int $id): \Illuminate\Http\JsonResponse
    {
        $sponsor = Sponsor::find($id);
        if (!$sponsor) {
            return response()->json(['status' => false, 'message' => 'Sponsor not found']);
        }
        $sponsor->delete();
        return response()->json(['status' => false, 'message' => 'Sponsor deleted']);
    }
}
