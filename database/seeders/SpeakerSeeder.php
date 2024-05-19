<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\EventHasSponsor;
use App\Models\Schedule;
use App\Models\ScheduleHasStage;
use App\Models\Speaker;
use App\Models\Sponsor;
use App\Models\Stage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class SpeakerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $speakers = [
            [
                "titul" => "Ing.",
                "first_name" => "Sofia",
                "last_name" => " Taylor",
                "company" => "Google",
                "occupation" => "Designer",
                "short_desc" => "The way of Learning Design is all about the way you look on anything you see, or how you do imagine about somthing in your dream , also you need to be creative.",
                "desc" => "The way of Learning Design is all about the way you look on anything you see, or how you do imagine about somthing in your dream , also you need to be creative.",
                "email" => "sofia.taylor@google.com",
                "phone" => "+02 596 355 32",
                "facebook" => "https://www.facebook.com",
                "instagram" => "https://www.instagram.com",
                "linkedin" => "https://www.linkedin.com",
                "image" => "https://cdn.vuetifyjs.com/images/lists/4.jpg",
                "thumbnail" => "https://cdn.vuetifyjs.com/images/lists/4.jpg"
            ],
            [
                "titul" => "Mgr.",
                "first_name" => "Ava",
                "last_name" => "Jones",
                "company" => "Google",
                "occupation" => "Developer",
                "short_desc" => "The way of Learning Design is all about the way you look on anything you see, or how you do imagine about somthing in your dream , also you need to be creative.",
                "desc" => "The way of Learning Design is all about the way you look on anything you see, or how you do imagine about somthing in your dream , also you need to be creative.",
                "email" => "a.jones@google.com",
                "phone" => "+02 596 355 32",
                "facebook" => "https://www.facebook.com",
                "instagram" => "https://www.instagram.com",
                "linkedin" => "https://www.linkedin.com",
                "image" => "https://cdn.vuetifyjs.com/images/lists/1.jpg",
                "thumbnail" => "https://cdn.vuetifyjs.com/images/lists/1.jpg"
            ],
            [
                "titul" => "Bc.",
                "first_name" => "Olivia",
                "last_name" => "Smith",
                "company" => "IBM",
                "occupation" => "Developer",
                "short_desc" => "The way of Learning Design is all about the way you look on anything you see, or how you do imagine about somthing in your dream , also you need to be creative.",
                "desc" => "The way of Learning Design is all about the way you look on anything you see, or how you do imagine about somthing in your dream , also you need to be creative.",
                "email" => "o.smith@ibm.com",
                "phone" => "+02 596 355 32",
                "facebook" => "https://www.facebook.com",
                "instagram" => "https://www.instagram.com",
                "linkedin" => "https://www.linkedin.com",
                "image" => "https://cdn.vuetifyjs.com/images/lists/2.jpg",
                "thumbnail" => "https://cdn.vuetifyjs.com/images/lists/2.jpg"
            ],
            [
                "titul" => "Ing.",
                "first_name" => "Mia",
                "last_name" => "Brown",
                "company" => "Microsoft",
                "occupation" => "Designer",
                "short_desc" => "The way of Learning Design is all about the way you look on anything you see, or how you do imagine about somthing in your dream , also you need to be creative.",
                "desc" => "The way of Learning Design is all about the way you look on anything you see, or how you do imagine about somthing in your dream , also you need to be creative.",
                "email" => "m.brown@microsoft.com",
                "phone" => "+02 596 355 32",
                "facebook" => "https://www.facebook.com",
                "instagram" => "https://www.instagram.com",
                "linkedin" => "https://www.linkedin.com",
                "image" => "https://cdn.vuetifyjs.com/images/lists/3.jpg",
                "thumbnail" => "https://cdn.vuetifyjs.com/images/lists/3.jpg"
            ],
            [
                "titul" => "Ing.",
                "first_name" => "Amelia",
                "last_name" => "Wilson",
                "company" => "Google",
                "occupation" => "Developer",
                "short_desc" => "The way of Learning Design is all about the way you look on anything you see, or how you do imagine about somthing in your dream , also you need to be creative.",
                "desc" => "The way of Learning Design is all about the way you look on anything you see, or how you do imagine about somthing in your dream , also you need to be creative.",
                "email" => "a.wilson@google.com",
                "phone" => "+02 596 355 32",
                "facebook" => "https://www.facebook.com",
                "instagram" => "https://www.instagram.com",
                "linkedin" => "https://www.linkedin.com",
                "image" => "https://cdn.vuetifyjs.com/images/lists/4.jpg",
                "thumbnail" => "https://cdn.vuetifyjs.com/images/lists/4.jpg"
            ],
            [
                "titul" => "Ing.",
                "first_name" => "Emily",
                "last_name" => "Moore",
                "company" => "ESET",
                "occupation" => "Designer",
                "short_desc" => "The way of Learning Design is all about the way you look on anything you see, or how you do imagine about somthing in your dream , also you need to be creative.",
                "desc" => "The way of Learning Design is all about the way you look on anything you see, or how you do imagine about somthing in your dream , also you need to be creative.",
                "email" => "e.moore@eset.com",
                "phone" => "+02 596 355 32",
                "facebook" => "https://www.facebook.com",
                "instagram" => "https://www.instagram.com",
                "linkedin" => "https://www.linkedin.com",
                "image" => "https://cdn.vuetifyjs.com/images/lists/3.jpg",
                "thumbnail" => "https://cdn.vuetifyjs.com/images/lists/3.jpg"
            ]
        ];

        Schema::disableForeignKeyConstraints();
        Speaker::truncate();

        foreach($speakers as $speaker) {
            Speaker::create($speaker);
        }

        Schema::enableForeignKeyConstraints();
    }
}
