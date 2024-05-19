<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\EventHasSponsor;
use App\Models\Sponsor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class SponsorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $sponsors = [
            [
                "name" => "IBM",
                "short_desc" => "IBM is a global technology and innovation company headquartered in Armonk, NY. It is the largest technology and consulting employer in the world, with more than 400,000 employees serving clients in 170 countries.",
                "desc" => "IBM is a global technology and innovation company headquartered in Armonk, NY. It is the largest technology and consulting employer in the world, with more than 400,000 employees serving clients in 170 countries.",
                "logo" => "https://upload.wikimedia.org/wikipedia/commons/thumb/5/51/IBM_logo.svg/1920px-IBM_logo.svg.png",
                "url" => "https://www.ibm.com/",
                "email" => "infoibm@us.ibm.com",
                "phone" => "+1 914-499-7777"
            ],
            [
                "name" => "Microsoft",
                "short_desc" => "Microsoft is an American multinational technology company with headquarters in Redmond, Washington. It develops, manufactures, licenses, supports, and sells computer software, consumer electronics, personal computers, and related services.",
                "desc" => "Microsoft is an American multinational technology company with headquarters in Redmond, Washington. It develops, manufactures, licenses, supports, and sells computer software, consumer electronics, personal computers, and related services.",
                "logo" => "https://upload.wikimedia.org/wikipedia/commons/thumb/9/96/Microsoft_logo_%282012%29.svg/1920px-Microsoft_logo_%282012%29.svg.png",
                "url" => "https://www.microsoft.com/",
                "email" => "msft@microsoft.com",
                "phone" => "+1 (425) 706-4400"
            ],
            [
                "name" => "Google",
                "short_desc" => "Google is an American multinational technology company that specializes in Internet-related services and products, which include online advertising technologies, search engine, cloud computing, software, and hardware.",
                "desc" => "Google is an American multinational technology company that specializes in Internet-related services and products, which include online advertising technologies, search engine, cloud computing, software, and hardware.",
                "logo" => "https://upload.wikimedia.org/wikipedia/commons/thumb/2/2f/Google_2015_logo.svg/1920px-Google_2015_logo.svg.png",
                "url" => "https://www.google.com/",
                "email" => "press@google.com",
                "phone" => "+1 (650) 253-0000"
            ]
        ];

        Schema::disableForeignKeyConstraints();
        Sponsor::truncate();

        $event = Event::where('is_current', true)->first();
        if ($event) {
            foreach ($sponsors as $sponsor) {
                Sponsor::create($sponsor);
                EventHasSponsor::create([
                    'event_id' => $event->event_id,
                    'sponsor_id' => Sponsor::latest()->first()->sponsor_id
                ]);
            }
        }

        Schema::enableForeignKeyConstraints();
    }
}
