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
                "title" => "Web Dev 2022",
                "desc_short" => "The future of web development",
                "desc" => "Web Dev 2022 is a conference that will focus on the future of web development. We will have speakers from all over the world talking about the latest technologies and trends in web development.",
                "year" => 2022,
                "start_date" => "2022-07-01",
                "end_date" => "2022-07-02",
                "image" => "https://images.unsplash.com/photo-1527686956515-6d2f2d1b4e1f",
                "thumbnail" => "https://images.unsplash.com/photo-1527686956515-6d2f2d1b4e1f",
                "is_current" => false,
                "location" => "Nitra, Slovakia",
                "place" => "UKF Nitra, Faculty of Natural Sciences",
                "address" => "Trieda A.Hlinku, 1, 949 01 Nitra, Slovakia"
            ],
            [
                "title" => "Web Dev 2023",
                "desc_short" => "The future of web development",
                "desc" => "Web Dev 2023 is a conference that will focus on the future of web development. We will have speakers from all over the world talking about the latest technologies and trends in web development.",
                "year" => 2023,
                "start_date" => "2023-07-01",
                "end_date" => "2023-07-02",
                "image" => "https://images.unsplash.com/photo-1527686956515-6d2f2d1b4e1f",
                "thumbnail" => "https://images.unsplash.com/photo-1527686956515-6d2f2d1b4e1f",
                "is_current" => false,
                "location" => "Nitra, Slovakia",
                "place" => "UKF Nitra, Faculty of Natural Sciences",
                "address" => "Trieda A.Hlinku, 1, 949 01 Nitra, Slovakia"
            ],
            [
                "title" => "Web Dev 2024",
                "desc_short" => "The future of web development",
                "desc" => "Web Dev 2024 is a conference that will focus on the future of web development. We will have speakers from all over the world talking about the latest technologies and trends in web development.",
                "year" => 2024,
                "start_date" => "2024-07-01",
                "end_date" => "2024-07-02",
                "image" => "https://images.unsplash.com/photo-1527686956515-6d2f2d1b4e1f",
                "thumbnail" => "https://images.unsplash.com/photo-1527686956515-6d2f2d1b4e1f",
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
