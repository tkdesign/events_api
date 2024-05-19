<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\MenuItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

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

class MenuItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Article::truncate();
        MenuItem::truncate();

        $menuItems = [
            [
                "name" => "home",
                "title" => "Home",
                "page_title" => "Home",
                "path" => "/",
                "component" => "HomeView",
                "visible" => true,
                "position" => 1,
                "role" => 1,
                "is_article" => false,
                'is_top_menu_item' => true,
                'is_bottom_menu_item' => false,
            ],
            [
                "name" => "speakers",
                "title" => "Speakers",
                "page_title" => "Speakers",
                "path" => "/speakers",
                "component" => "SpeakersView",
                "visible" => true,
                "position" => 2,
                "role" => 1,
                "is_article" => false,
                'is_top_menu_item' => true,
                'is_bottom_menu_item' => true,
            ],
            [
                "name" => "schedule",
                "title" => "Schedule",
                "page_title" => "Schedule",
                "path" => "/schedule",
                "component" => "ScheduleView",
                "visible" => true,
                "position" => 3,
                "role" => 1,
                "is_article" => false,
                'is_top_menu_item' => true,
                'is_bottom_menu_item' => true,
            ],
            [
                "name" => "sponsors",
                "title" => "Sponsors",
                "page_title" => "Sponsors",
                "path" => "/sponsors",
                "component" => "SponsorsView",
                "visible" => true,
                "position" => 4,
                "role" => 1,
                "is_article" => false,
                'is_top_menu_item' => true,
                'is_bottom_menu_item' => true,
            ],
            [
                "name" => "gallery",
                "title" => "Gallery",
                "page_title" => "Gallery",
                "path" => "/gallery",
                "component" => "GalleryView",
                "visible" => true,
                "position" => 5,
                "role" => 1,
                "is_article" => false,
                'is_top_menu_item' => true,
                'is_bottom_menu_item' => true,
            ],
            [
                "name" => "gallery_year",
                "title" => "Gallery",
                "page_title" => "Gallery by year",
                "path" => "/gallery/:year",
                "component" => "GalleryView",
                "visible" => false,
                "position" => 6,
                "role" => 1,
                "is_article" => false,
                'is_top_menu_item' => true,
                'is_bottom_menu_item' => false,
            ],
            [
                "name" => "contacts",
                "title" => "Contacts",
                "page_title" => "Contacts",
                "path" => "/contacts",
                "component" => "ContactsView",
                "visible" => true,
                "position" => 7,
                "role" => 1,
                "is_article" => false,
                'is_top_menu_item' => true,
                'is_bottom_menu_item' => true,
            ],
            [
                "name" => "sign-in",
                "title" => "Sign in",
                "page_title" => "Login page",
                "path" => "/sign-in",
                "component" => "SignInView",
                "visible" => true,
                "position" => 8,
                "role" => 1,
                "is_article" => false,
                'is_top_menu_item' => true,
                'is_bottom_menu_item' => false,
            ],
            [
                "name" => "sign-up",
                "title" => "Sign up",
                "page_title" => "Registration page",
                "path" => "/sign-up",
                "component" => "SignUpView",
                "visible" => true,
                "position" => 9,
                "role" => 1,
                "is_article" => false,
                'is_top_menu_item' => true,
                'is_bottom_menu_item' => false,
            ],
            [
                "name" => "about",
                "title" => "About",
                "page_title" => "About",
                "path" => "/about",
                "component" => "CustomPageView",
                "visible" => true,
                "position" => 1,
                "role" => 1,
                "is_article" => true,
                'is_top_menu_item' => false,
                'is_bottom_menu_item' => true,
            ],
            [
                "name" => "workshops",
                "title" => "Workshops",
                "page_title" => "Workshops",
                "path" => "/workshops",
                "component" => "CustomPageView",
                "visible" => true,
                "position" => 2,
                "role" => 1,
                "is_article" => true,
                'is_top_menu_item' => false,
                'is_bottom_menu_item' => true,
            ],
            [
                "name" => "terms",
                "title" => "Terms",
                "page_title" => "Terms",
                "path" => "/terms",
                "component" => "CustomPageView",
                "visible" => true,
                "position" => 3,
                "role" => 1,
                "is_article" => true,
                'is_top_menu_item' => false,
                'is_bottom_menu_item' => true,
            ],
            [
                "name" => "privacy",
                "title" => "Privacy",
                "page_title" => "Privacy",
                "path" => "/privacy",
                "component" => "CustomPageView",
                "visible" => true,
                "position" => 4,
                "role" => 1,
                "is_article" => true,
                'is_top_menu_item' => false,
                'is_bottom_menu_item' => true,
            ]
        ];

        $articles = [
            [
                "title" => "About the event",
                "short_desc" => "<p>This is a conference for web developers. We will have a lot of interesting speakers and workshops. You can learn a lot of new things and meet new people. We will have a lot of fun and you will not regret coming to our event.</p>",
                "desc" => "<p>This is a conference for web developers. We will have a lot of interesting speakers and workshops. You can learn a lot of new things and meet new people. We will have a lot of fun and you will not regret coming to our event.</p><h4 class='text-h4'>Speakers</h4><p>Our speakers are the best in the industry. They will share their knowledge and experience with you. You will learn a lot of new things and get inspired. You will not regret coming to our event.</p><h4 class='text-h4'>Workshops</h4><p>We will have a lot of interesting workshops. You can learn new things and improve your skills. You will have a lot of fun and meet new people. You will not regret coming to our event.</p><h4 class='text-h4'>Networking</h4><p>You will have the opportunity to meet new people and make new friends. You can share your knowledge and experience with others. You will have a lot of fun and you will not regret coming to our event.</p><h4 class='text-h4'>Location</h4><p>The event will take place in the city center. The venue is easy to reach by public transport. You will have a lot of fun and you will not regret coming to our event.</p><h4 class='text-h4'>Tickets</h4><p>You can buy tickets online or at the venue. The price is affordable and you will get a lot of value for your money. You will have a lot of fun and you will not regret coming to our event.</p><h4 class='text-h4'>Sponsors</h4><p>We have a lot of sponsors who support our event. They will provide you with food and drinks. You will have a lot of fun and you will not regret coming to our event.</p><h4 class='text-h4'>Contact</h4><p>If you have any questions, please contact us. We will be happy to help you. You will have a lot of fun and you will not regret coming to our event.</p>"
            ],
            [
                "title" => "Workshops",
                "short_desc" => "<p>We will have a lot of interesting workshops. You can learn new things and improve your skills. You will have a lot of fun and meet new people. You will not regret coming to our event.</p>",
                "desc" => "<p>We will have a lot of interesting workshops. You can learn new things and improve your skills. You will have a lot of fun and meet new people. You will not regret coming to our event.</p><h4 class='text-h4'>Workshop 1</h4><p>Workshop 1 is about web design. You will learn how to create beautiful and user-friendly websites. You will have a lot of fun and meet new people. You will not regret coming to our event.</p><h4 class='text-h4'>Workshop 2</h4><p>Workshop 2 is about front-end development. You will learn how to create interactive and responsive websites. You will have a lot of fun and meet new people. You will not regret coming to our event.</p><h4 class='text-h4'>Workshop 3</h4><p>Workshop 3 is about back-end development. You will learn how to create secure and scalable websites. You will have a lot of fun and meet new people. You will not regret coming to our event.</p><h4 class='text-h4'>Workshop 4</h4><p>Workshop 4 is about mobile development. You will learn how to create mobile-friendly websites. You will have a lot of fun and meet new people. You will not regret coming to our event.</p>"
            ],
            [
                "title" => "Terms and conditions",
                "short_desc" => "<p>These are the terms and conditions for our event. Please read them carefully before buying a ticket. You will have a lot of fun and you will not regret coming to our event.</p>",
                "desc" => "<p><h2>1. Acceptance of Terms</h2>\n    <p>By accessing or using this website, you agree to be bound by these Terms and Conditions, our Privacy Policy, and all applicable laws and regulations.</p>\n    \n    <h2>2. Registration</h2>\n    <p>In order to attend conferences listed on this website, you may be required to register and provide certain information. You agree to provide accurate, current, and complete information during the registration process.</p>\n    \n    <h2>3. Payment and Refund Policy</h2>\n    <p>All payments made for conference registrations are non-refundable unless otherwise specified. Refunds, if applicable, will be processed according to our refund policy.</p>\n    \n    <h2>4. Intellectual Property</h2>\n    <p>All content provided on this website, including but not limited to text, graphics, logos, images, audio clips, and video clips, is the property of the conference organizers and is protected by copyright laws.</p>\n    \n    <h2>5. Code of Conduct</h2>\n    <p>All participants are expected to conduct themselves in a professional and respectful manner during conferences and related events. Any form of harassment, discrimination, or disruptive behavior will not be tolerated and may result in expulsion from the event.</p>\n    \n    <h2>6. Limitation of Liability</h2>\n    <p>We shall not be liable for any indirect, incidental, special, consequential, or punitive damages, or any loss of profits or revenues, whether incurred directly or indirectly, arising from your use of this website or attendance at any conference listed herein.</p>\n    \n    <h2>7. Governing Law</h2>\n    <p>These Terms and Conditions shall be governed by and construed in accordance with the laws of the United States of America.</p>\n    \n    <h2>8. Changes to Terms</h2>\n    <p>We reserve the right to modify or replace these Terms and Conditions at any time without prior notice. It is your responsibility to review this page periodically for changes.</p>\n    \n    <h2>9. Contact Us</h2>\n    <p>If you have any questions or concerns about these Terms and Conditions, please contact us at <a href=\"mailto:info@conferencewebsite.com\">info@conferencewebsite.com</a>.</p></p>"
            ],
            [
                "title" => "Privacy policy",
                "short_desc" => "<p>This is the privacy policy for our event. Please read it carefully before buying a ticket. You will have a lot of fun and you will not regret coming to our event.</p>",
                "desc" => "<p></p><h2>1. Information We Collect</h2>\n    <p>We collect personal information from you when you register for a conference, purchase a ticket, or subscribe to our newsletter. This information may include your name, email address, phone number, and payment details.</p>\n    \n    <h2>2. How We Use Your Information</h2>\n    <p>We use the information we collect from you to process your registration, purchase, or subscription, and to communicate with you about upcoming conferences and events. We may also use your information to improve our website and services.</p>\n    \n    <h2>3. How We Protect Your Information</h2>\n    <p>We take appropriate security measures to protect your personal information from unauthorized access, disclosure, alteration, or destruction. We use encryption to safeguard your payment details and other sensitive information.</p>\n    \n    <h2>4. Sharing Your Information</h2>\n    <p>We do not sell, trade, or rent your personal information to third parties. We may share your information with service providers who help us process payments, send emails, or manage our website. These service providers are required to protect your information and use it only for the purposes we specify.</p>\n    \n    <h2>5. Cookies</h2>\n    <p>We use cookies to collect information about your browsing behavior and preferences. Cookies are small text files that are stored on your device when you visit our website. You can disable cookies in your browser settings, but this may affect your experience on our website.</p>\n    \n    <h2>6. Changes to Privacy Policy</h2>\n    <p>We reserve the right to modify or replace this Privacy Policy at any time without prior notice. It is your responsibility to review this page periodically for changes.</p>\n    \n    <h2>7. Contact Us</h2>\n    <p>If you have any questions or concerns about this Privacy Policy, please contact us at <a href=\"mailto:events@localhost\">events@localhost</a>.</p>"
            ]
        ];

        foreach ($menuItems as $menuItem) {
            $insertedMenuItem = MenuItem::create($menuItem);
            if ($insertedMenuItem && $menuItem['is_article']) {
                $article = $articles[$menuItem['position'] - 1];
                $article['menu_item_id'] = $insertedMenuItem->menu_item_id;
                Article::create($article);
            }
        }

        Schema::enableForeignKeyConstraints();
    }
}
