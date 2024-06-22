<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $events = [
            [
                "title" => "nConnect 2022",
                "desc_short" => "Driving IT Innovation Forward",
                "desc" => "nConnect 2022 upholds our tradition, focusing on current innovations in IT. This year, the conference will gather experts and professionals to discuss the latest developments and directions in the industry. It serves as an essential platform for IT students and specialists to exchange ideas and knowledge, supporting our mission to enhance interaction and cooperation within the local IT community.",
                "about_title" => "A FEW WORDS ABOUT THE NCONNECT CONFERENCE",
                "about_text" => "After years of thinking and planning, we created nConnect, a unique event in Nitra that brings together IT students and leading companies in this dynamic industry. The nConnect conference follows the long tradition of the \"IT in Practice\" format of the Constantine the Philosopher University in Nitra. This initiative is a bridge between a new generation of talent and experienced professionals, providing a platform for exchange of ideas and inspiration for each other. Our mission was clear: to fill the gap in local IT communication and collaboration, and nConnect is the proud result of this vision.",
                "left_block_title" => "WHO WE ARE?",
                "left_block_text" => "We are a group of IT enthusiasts from the academic and business communities.",
                "right_block_title" => "WHAT DO WE WANT?",
                "right_block_text" => "To create an event that will bring together the IT community in Nitra on a regular basis.",
                "year" => 2022,
                "start_date" => "2022-07-01",
                "end_date" => "2022-07-02",
                "image" => "/images/events/1719080549.jpg",
                "thumbnail" => "/images/events/thumbnails/1719080549.jpg",
                "map" => "/images/events/maps/1719079948.png",
                "is_current" => false,
                "location" => "Nitra, Slovakia",
                "place" => "UKF Nitra, Faculty of Natural Sciences",
                "address" => "Trieda A.Hlinku, 1, 949 01 Nitra, Slovakia"
            ],
            [
                "title" => "nConnect 2023",
                "desc_short" => "Innovate, Connect, Inspire",
                "desc" => "nConnect 2023 continues the tradition, with a special focus on the latest advancements in the IT industry. This year, the conference will bring together top experts from around the world to share insights on cutting-edge technologies and trends. It is a unique opportunity for IT students and professionals to connect, learn, and inspire each other, reinforcing our commitment to bridging the gap in local IT communication and collaboration.",
                "about_title" => "A FEW WORDS ABOUT THE NCONNECT CONFERENCE",
                "about_text" => "After years of thinking and planning, we created nConnect, a unique event in Nitra that brings together IT students and leading companies in this dynamic industry. The nConnect conference follows the long tradition of the \"IT in Practice\" format of the Constantine the Philosopher University in Nitra. This initiative is a bridge between a new generation of talent and experienced professionals, providing a platform for exchange of ideas and inspiration for each other. Our mission was clear: to fill the gap in local IT communication and collaboration, and nConnect is the proud result of this vision.",
                "left_block_title" => "WHO WE ARE?",
                "left_block_text" => "We are a group of IT enthusiasts from the academic and business communities.",
                "right_block_title" => "WHAT DO WE WANT?",
                "right_block_text" => "To create an event that will bring together the IT community in Nitra on a regular basis.",
                "year" => 2023,
                "start_date" => "2023-07-01",
                "end_date" => "2023-07-02",
                "image" => "/images/events/1719080564.jpg",
                "thumbnail" => "/images/events/thumbnails/1719080564.jpg",
                "map" => "/images/events/maps/1719079939.png",
                "is_current" => false,
                "location" => "Nitra, Slovakia",
                "place" => "UKF Nitra, Faculty of Natural Sciences",
                "address" => "Trieda A.Hlinku, 1, 949 01 Nitra, Slovakia"
            ],
            [
                "title" => "nConnect 2024",
                "desc_short" => "Shaping the Future of IT Together",
                "desc" => "nConnect 2024 continues this tradition, focusing on the future of the IT industry. This year, the conference will gather speakers from around the world who will share insights on the latest technologies and trends. It’s an opportunity for IT students and professionals to connect, learn, and inspire each other, reinforcing our commitment to bridging the gap in local IT communication and collaboration.",
                "about_title" => "A FEW WORDS ABOUT THE NCONNECT CONFERENCE",
                "about_text" => "After years of thinking and planning, we created nConnect, a unique event in Nitra that brings together IT students and leading companies in this dynamic industry. The nConnect conference follows the long tradition of the \"IT in Practice\" format of the Constantine the Philosopher University in Nitra. This initiative is a bridge between a new generation of talent and experienced professionals, providing a platform for exchange of ideas and inspiration for each other. Our mission was clear: to fill the gap in local IT communication and collaboration, and nConnect is the proud result of this vision.",
                "left_block_title" => "WHO WE ARE?",
                "left_block_text" => "We are a group of IT enthusiasts from the academic and business communities.",
                "right_block_title" => "WHAT DO WE WANT?",
                "right_block_text" => "To create an event that will bring together the IT community in Nitra on a regular basis.",
                "year" => 2024,
                "start_date" => "2024-07-01",
                "end_date" => "2024-07-02",
                "image" => "/images/events/1719080575.jpg",
                "thumbnail" => "/images/events/thumbnails/1719080564.jpg",
                "map" => "/images/events/maps/1719079929.png",
                "is_current" => true,
                "location" => "Nitra, Slovakia",
                "place" => "UKF Nitra, Faculty of Natural Sciences",
                "address" => "Trieda A.Hlinku, 1, 949 01 Nitra, Slovakia"
            ]
        ];

        Schema::disableForeignKeyConstraints();
        Event::truncate();

        foreach ($events as $event) {
            Event::create($event);
        }

        Schema::enableForeignKeyConstraints();
    }
}
