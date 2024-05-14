<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use Illuminate\Http\Request;
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
  `is_top_menu_item` TINYINT NULL DEFAULT 1,
  `is_bottom_menu_item` TINYINT NULL DEFAULT 1,
  PRIMARY KEY (`menu_item_id`),
  INDEX `menu_items_role_position_idx` (`role` ASC, `position` ASC) VISIBLE,
  INDEX `menu_items_created_at_idx` (`created_at` ASC) VISIBLE)
ENGINE = InnoDB;
*/

/*
{
  "menu": [
    {
      "name": "home",
      "title": "Home",
      "page_title": "Home",
      "alias": "/",
      "component": "HomeView",
      "visible": true
    },
    {
      "name": "speakers",
      "title": "Speakers",
      "page_title": "Speakers",
      "alias": "/speakers",
      "component": "SpeakersView",
      "visible": true
    },
    {
      "name": "schedule",
      "title": "Schedule",
      "page_title": "Schedule",
      "alias": "/schedule",
      "component": "ScheduleView",
      "visible": true
    },
    {
      "name": "sponsors",
      "title": "Sponsors",
      "page_title": "Sponsors",
      "alias": "/sponsors",
      "component": "SponsorsView",
      "visible": true
    },
    {
      "name": "gallery",
      "title": "Gallery",
      "page_title": "Gallery",
      "alias": "/gallery",
      "component": "GalleryView",
      "visible": true
    },
    {
      "name": "gallery_year",
      "title": "Gallery",
      "page_title": "Gallery by year",
      "alias": "/gallery/:year",
      "component": "GalleryView",
      "visible": false
    },
    {
      "name": "contacts",
      "title": "Contacts",
      "page_title": "Contacts",
      "alias": "/contacts",
      "component": "ContactsView",
      "visible": true
    },
    {
      "name": "sign-in",
      "title": "Sign in",
      "page_title": "Login page",
      "alias": "/sign-in",
      "component": "SignInView",
      "visible": true
    },
    {
      "name": "sign-up",
      "title": "Sign up",
      "page_title": "Registration page",
      "alias": "/sign-up",
      "component": "SignUpView",
      "visible": true
    }
  ],
  "bottom_menu": [
    {
      "type": "subheader",
      "title": "Main",
      "visible": true
    },
    {
      "name": "speakers",
      "title": "Speakers",
      "page_title": "Speakers",
      "alias": "/speakers",
      "component": "SpeakersView",
      "visible": true
    },
    {
      "name": "schedule",
      "title": "Schedule",
      "page_title": "Schedule",
      "alias": "/schedule",
      "component": "ScheduleView",
      "visible": true
    },
    {
      "name": "sponsors",
      "title": "Sponsors",
      "page_title": "Sponsors",
      "alias": "/sponsors",
      "component": "SponsorsView",
      "visible": true
    },
    {
      "name": "gallery",
      "title": "Gallery",
      "page_title": "Gallery",
      "alias": "/gallery",
      "component": "GalleryView",
      "visible": true
    },
    {
      "name": "contacts",
      "title": "Contacts",
      "page_title": "Contacts",
      "alias": "/contacts",
      "component": "ContactsView",
      "visible": true
    },
    {
      "type": "subheader",
      "title": "Topics",
      "visible": true
    },
    {
      "name": "about",
      "title": "About",
      "page_title": "About",
      "alias": "/about",
      "component": "CustomPageView",
      "visible": true
    },
    {
      "name": "workshops",
      "title": "Workshops",
      "page_title": "Workshops",
      "alias": "/workshops",
      "component": "CustomPageView",
      "visible": true
    },
    {
      "name": "terms",
      "title": "Terms",
      "page_title": "Terms",
      "alias": "/terms",
      "component": "CustomPageView",
      "visible": true
    },
    {
      "name": "privacy",
      "title": "Privacy",
      "page_title": "Privacy",
      "alias": "/privacy",
      "component": "CustomPageView",
      "visible": true
    }
  ]
}
*/
class MenuController extends Controller
{
    //
    public function getMenu()
    {
        $topMenu = MenuItem::all(array('name', 'title', 'page_title', 'path as alias', 'component', 'visible', 'position', 'role', 'is_article', 'is_top_menu_item', 'is_bottom_menu_item'))
            ->where('role', '=', 1)
            ->where('is_top_menu_item', '=', true)
            ->sortBy('position')->toArray();
        $bottomMenu = MenuItem::all(array('name', 'title', 'page_title', 'path as alias', 'component', 'visible', 'position', 'role', 'is_article', 'is_top_menu_item', 'is_bottom_menu_item'))
            ->where('role', '=', 1)
            ->where('is_bottom_menu_item', '=', true)
            ->sortBy('position')->toArray();
        $main_menu = [];
        foreach ($topMenu as $item) {
            $main_menu[] = $item;
        }
        $menu = [
            'menu' => $main_menu,
        ];
        $bottom_submenu_main = [];
        $bottom_submenu_topics = [];

        $bottom_submenu_main[] = [
            'type' => 'subheader',
            'title' => 'Main',
            'visible' => true
        ];
        $bottom_submenu_topics[] = [
            'type' => 'subheader',
            'title' => 'Topics',
            'visible' => true
        ];
        foreach ($bottomMenu as $item) {
            if ($item['is_top_menu_item'] && $item['is_bottom_menu_item']) {
                $bottom_submenu_main[] = $item;
            }
        }
        foreach ($bottomMenu as $item) {
            if (!$item['is_top_menu_item'] && $item['is_bottom_menu_item']) {
                $bottom_submenu_topics[] = $item;
            }
        }
        $menu['bottom_menu'] = array_merge($bottom_submenu_main, $bottom_submenu_topics);
        return response()->json($menu);
    }
}
