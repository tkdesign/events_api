<?php

namespace Database\Seeders;

use App\Models\Curator;
use App\Models\Event;
use App\Models\EventHasCurator;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class CuratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $curators = [
            [
                "titul" => "Ing.",
                "first_name" => "PAVOL",
                "last_name" => "KOLLAR",
                "company" => "UKF",
                "occupation" => "Organizer",
                "phone" => "+421 596 355 32",
                "email" => "pavel_kollar@ukf.sk",
                "photo_url" => "/images/curators/1719102063.jpg"
            ],
            [
                "titul" => "Ing.",
                "first_name" => "INGRID",
                "last_name" => "KOLLAR",
                "company" => "UKF",
                "occupation" => "Planer",
                "phone" => "+421 596 355 32",
                "email" => "ingrid_kollar@ukf.sk",
                "photo_url" => "/images/curators/1719102072.jpg"
            ]
        ];

        Schema::disableForeignKeyConstraints();
        Curator::truncate();

        $event = Event::where('is_current', true)->first();
        if ($event) {
            $event_id = $event->event_id;
            foreach ($curators as $curator) {
                Curator::create($curator);
                EventHasCurator::create([
                    'event_id' => $event_id,
                    'curator_id' => Curator::latest()->first()->curator_id
                ]);
            }
        }

        Schema::enableForeignKeyConstraints();
    }
}
