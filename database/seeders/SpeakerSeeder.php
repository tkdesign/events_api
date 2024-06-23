<?php

namespace Database\Seeders;

use App\Models\Speaker;
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
                "image" => "/images/speakers/1719101245.jpg",
                "thumbnail" => "/images/speakers/1719101245.jpg"
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
                "image" => "/images/speakers/1719101144.jpg",
                "thumbnail" => "/images/speakers/1719101144.jpg"
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
                "image" => "/images/speakers/1719101200.jpg",
                "thumbnail" => "/images/speakers/1719101200.jpg"
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
                "image" => "/images/speakers/1719101115.jpg",
                "thumbnail" => "/images/speakers/1719101115.jpg"
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
                "image" => "/images/speakers/1719101054.jpg",
                "thumbnail" => "/images/speakers/1719101054.jpg"
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
                "image" => "/images/speakers/1719101079.jpg",
                "thumbnail" => "/images/speakers/1719101079.jpg"
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
