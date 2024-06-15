<?php

namespace Database\Seeders;

use App\Models\Lecture;
use App\Models\LectureHasSpeaker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class LectureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $lectures = [
            [
                "title" => "The Future of Technology",
                "short_desc" => "The Future of Technology is a talk about the future of technology. This talk will cover the latest trends in technology and what we can expect to see in the future.",
                "desc" => "John Doe is a technology enthusiast. He has been working in the technology industry for over 10 years. He has worked with some of the biggest companies in the world. He is a well-known speaker and has spoken at many events around the world. He is known for his knowledge and passion for technology.",
                "image" => "https://picsum.photos/300/200?image=60",
                "capacity" => 100,
                "speaker_id" => 1
            ],
            [
                "title" => "The Future of Business",
                "short_desc" => "The Future of Business is a talk about the future of business. This talk will cover the latest trends in business and what we can expect to see in the future.",
                "desc" => "Jane Doe is a business expert. She has been working in the business industry for over 10 years. She has worked with some of the biggest companies in the world. She is a well-known speaker and has spoken at many events around the world. She is known for her knowledge and passion for business.",
                "image" => "https://picsum.photos/300/200?image=59",
                "capacity" => 300,
                "speaker_id" => 2
            ],
            [
                "lecture_id" => "3",
                "title" => "The Future of Marketing",
                "short_desc" => "The Future of Marketing is a talk about the future of marketing. This talk will cover the latest trends in marketing and what we can expect to see in the future.",
                "desc" => "Jack Doe is a marketing expert. He has been working in the marketing industry for over 10 years. He has worked with some of the biggest companies in the world. He is a well-known speaker and has spoken at many events around the world. He is known for his knowledge and passion for marketing.",
                "image" => "https://picsum.photos/300/200?image=58",
                "capacity" => 200,
                "speaker_id" => 2
            ],
            [
                "title" => "The Future of Technology",
                "short_desc" => "The Future of Technology is a talk about the future of technology. This talk will cover the latest trends in technology and what we can expect to see in the future.",
                "desc" => "John Doe is a technology enthusiast. He has been working in the technology industry for over 10 years. He has worked with some of the biggest companies in the world. He is a well-known speaker and has spoken at many events around the world. He is known for his knowledge and passion for technology.",
                "image" => "https://picsum.photos/300/200?image=55",
                "capacity" => 100,
                "speaker_id" => 4,
            ],
            [
                "title" => "The Future of Business",
                "short_desc" => "The Future of Business is a talk about the future of business. This talk will cover the latest trends in business and what we can expect to see in the future.",
                "desc" => "Jane Doe is a business expert. She has been working in the business industry for over 10 years. She has worked with some of the biggest companies in the world. She is a well-known speaker and has spoken at many events around the world. She is known for her knowledge and passion for business.",
                "image" => "https://picsum.photos/300/200?image=56",
                "capacity" => 300,
                "speaker_id" => 5,
            ],
            [
                "title" => "The Future of Marketing",
                "short_desc" => "The Future of Marketing is a talk about the future of marketing. This talk will cover the latest trends in marketing and what we can expect to see in the future.",
                "desc" => "Jack Doe is a marketing expert. He has been working in the marketing industry for over 10 years. He has worked with some of the biggest companies in the world. He is a well-known speaker and has spoken at many events around the world. He is known for his knowledge and passion for marketing.",
                "image" => "https://picsum.photos/300/200?image=57",
                "capacity" => 200,
                "speaker_id" => 6,
            ]
        ];

        Schema::disableForeignKeyConstraints();
        Lecture::truncate();

        foreach ($lectures as $lecture) {
            $speaker_id = $lecture['speaker_id'];
            unset($lecture['speaker_id']);
            Lecture::create($lecture);
            LectureHasSpeaker::create([
                'lecture_id' => Lecture::latest()->first()->lecture_id,
                'speaker_id' => $speaker_id
            ]);
        }

        Schema::enableForeignKeyConstraints();
    }
}
