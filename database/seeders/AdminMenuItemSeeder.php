<?php

namespace Database\Seeders;

use App\Models\AdminMenuItem;
use App\Models\MenuItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class AdminMenuItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Schema::disableForeignKeyConstraints();

        $adminMenuItems = [
            [
                "name" => "admin_events",
                "icon_class" => "mdi-forum",
                "title" => "Events",
                "page_title" => "Events",
                "path" => "/admin/events",
                "router_link" => "events",
                "component" => "AdminEventsView",
                "visible" => true,
                "position" => 1,
            ],
            [
                "name" => "admin_sponsors",
                "icon_class" => "mdi-handshake",
                "title" => "Sponsors",
                "page_title" => "Sponsors",
                "path" => "/admin/sponsors",
                "router_link" => "sponsors",
                "component" => "AdminSponsorsView",
                "visible" => true,
                "position" => 2,
            ],
            [
                "name" => "admin_events_sponsors",
                "icon_class" => "",
                "title" => "Events/Sponsors Relations",
                "page_title" => "Events/Sponsors Relations",
                "path" => "/admin/events-sponsors",
                "router_link" => "events-sponsors",
                "component" => "AdminEventsSponsorsView",
                "visible" => true,
                "position" => 3,
            ],
            [
                "name" => "admin_curators",
                "icon_class" => "mdi-account-supervisor",
                "title" => "Curators",
                "page_title" => "Curators",
                "path" => "/admin/curators",
                "router_link" => "curators",
                "component" => "AdminCuratorsView",
                "visible" => true,
                "position" => 4,
            ],
            [
                "name" => "admin_events_curators",
                "icon_class" => "",
                "title" => "Events/Curators Relations",
                "page_title" => "Events/Curators Relations",
                "path" => "/admin/events-curators",
                "router_link" => "events-curators",
                "component" => "AdminEventsCuratorsView",
                "visible" => true,
                "position" => 5,
            ],
            [
                "name" => "admin_schedules",
                "icon_class" => "mdi-calendar-clock",
                "title" => "Schedules",
                "page_title" => "Schedules",
                "path" => "/admin/schedules",
                "router_link" => "schedules",
                "component" => "AdminSchedulesView",
                "visible" => true,
                "position" => 6,
            ],
            [
                "name" => "admin_stages",
                "icon_class" => "mdi-theater",
                "title" => "Stages",
                "page_title" => "Stages",
                "path" => "/admin/stages",
                "router_link" => "stages",
                "component" => "AdminStagesView",
                "visible" => true,
                "position" => 7,
            ],
            [
                "name" => "admin_schedules_stages",
                "icon_class" => "",
                "title" => "Schedules/Stages Relations",
                "page_title" => "Schedules/Stages Relations",
                "path" => "/admin/schedules-stages",
                "router_link" => "schedules-stages",
                "component" => "AdminSchedulesStagesView",
                "visible" => true,
                "position" => 8,
            ],
            [
                "name" => "admin_slots",
                "icon_class" => "mdi-timeline-clock",
                "title" => "Slots",
                "page_title" => "Slots",
                "path" => "/admin/slots",
                "router_link" => "slots",
                "component" => "AdminSlotsView",
                "visible" => true,
                "position" => 9,
            ],
            [
                "name" => "admin_lectures",
                "icon_class" => "mdi-presentation-play",
                "title" => "Lectures",
                "page_title" => "Lectures",
                "path" => "/admin/lectures",
                "router_link" => "lectures",
                "component" => "AdminLecturesView",
                "visible" => true,
                "position" => 10,
            ],
            [
                "name" => "admin_speakers",
                "icon_class" => "mdi-lectern",
                "title" => "Speakers",
                "page_title" => "Speakers",
                "path" => "/admin/speakers",
                "router_link" => "speakers",
                "component" => "AdminSpeakersView",
                "visible" => true,
                "position" => 12,
            ],
            [
                "name" => "admin_lectures_speakers",
                "icon_class" => "",
                "title" => "Lectures/Speakers Relations",
                "page_title" => "Lectures/Speakers Relations",
                "path" => "/admin/lectures-speakers",
                "router_link" => "lectures-speakers",
                "component" => "AdminLecturesSpeakersView",
                "visible" => true,
                "position" => 13,
            ],
            [
                "name" => "admin_users",
                "icon_class" => "mdi-account-group",
                "title" => "Users",
                "page_title" => "Users",
                "path" => "/admin/users",
                "router_link" => "users",
                "component" => "AdminUsersView",
                "visible" => true,
                "position" => 14,
            ],
            [
                "name" => "admin_lectures_users",
                "icon_class" => "",
                "title" => "Lectures/Users Relations",
                "page_title" => "Lectures/Users Relations",
                "path" => "/admin/lectures-users",
                "router_link" => "lectures-users",
                "component" => "AdminLecturesUsersView",
                "visible" => true,
                "position" => 15,
            ],
            [
                "name" => "admin_events_users",
                "icon_class" => "",
                "title" => "Events/Users Relations",
                "page_title" => "Events/Users Relations",
                "path" => "/admin/events-users",
                "router_link" => "events-users",
                "component" => "AdminEventsUsersView",
                "visible" => true,
                "position" => 16,
            ],
            [
                "name" => "admin_testimonials",
                "icon_class" => "mdi-account",
                "title" => "Testimonials",
                "page_title" => "Testimonials",
                "path" => "/admin/testimonials",
                "router_link" => "testimonials",
                "component" => "AdminTestimonialsView",
                "visible" => true,
                "position" => 17,
            ],
            [
                "name" => "admin_galleries",
                "icon_class" => "mdi-folder-multiple-image",
                "title" => "Galleries",
                "page_title" => "Galleries",
                "path" => "/admin/galleries",
                "router_link" => "galleries",
                "component" => "AdminGalleriesView",
                "visible" => true,
                "position" => 18,
            ],
            [
                "name" => "admin_images",
                "icon_class" => "mdi-image-multiple",
                "title" => "Images",
                "page_title" => "Images",
                "path" => "/admin/images",
                "router_link" => "images",
                "component" => "AdminImagesView",
                "visible" => true,
                "position" => 19,
            ],
            [
                "name" => "admin_menu",
                "icon_class" => "mdi-menu",
                "title" => "Menu",
                "page_title" => "Menu",
                "path" => "/admin/menu",
                "router_link" => "menu",
                "component" => "AdminMenuView",
                "visible" => true,
                "position" => 20,
            ],
            [
                "name" => "admin_articles",
                "icon_class" => "mdi-note-multiple",
                "title" => "Articles",
                "page_title" => "Articles",
                "path" => "/admin/articles",
                "router_link" => "articles",
                "component" => "AdminArticlesView",
                "visible" => true,
                "position" => 21,
            ],
            [
                "name" => "admin_banners",
                "icon_class" => "mdi-note-multiple",
                "title" => "Banners",
                "page_title" => "Banners",
                "path" => "/admin/banners",
                "router_link" => "banners",
                "component" => "AdminBannersView",
                "visible" => true,
                "position" => 22,
            ],
        ];

        AdminMenuItem::truncate();

        foreach ($adminMenuItems as $adminMenuItem) {
            AdminMenuItem::create($adminMenuItem);
        }

        Schema::enableForeignKeyConstraints();
    }
}
