<?php

namespace Database\Seeders;

use App\Models\Lection;
use App\Models\LectionHasSpeaker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class LectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $lections = [
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
                "lection_id" => "3",
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
        Lection::truncate();

        foreach ($lections as $lection) {
            $speaker_id = $lection['speaker_id'];
            unset($lection['speaker_id']);
            Lection::create($lection);
            LectionHasSpeaker::create([
                'lection_id' => Lection::latest()->first()->lection_id,
                'speaker_id' => $speaker_id
            ]);
        }

        Schema::enableForeignKeyConstraints();
    }
}
