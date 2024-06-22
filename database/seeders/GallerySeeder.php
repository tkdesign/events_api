<?php

namespace Database\Seeders;

use App\Models\Gallery;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $galleries = [
            [
                'event_id' => 1,
                'title' => 'nConnect 2022',
                'short_desc' => 'nConnect 2022',
                'desc' => 'This is the gallery for the nConnect 2022 conference.',
            ],
            [
                'event_id' => 2,
                'title' => 'nConnect 2023',
                'short_desc' => 'nConnect 2023',
                'desc' => 'This is the gallery for the nConnect 2023 conference.',
            ],
            [
                'event_id' => 3,
                'title' => 'nConnect 2024',
                'short_desc' => 'nConnect 2024',
                'desc' => 'This is the gallery for the nConnect 2024 conference.',
            ]
        ];

        Schema::disableForeignKeyConstraints();
        Gallery::truncate();

        foreach ($galleries as $gallery) {
            Gallery::create($gallery);
        }

        Schema::enableForeignKeyConstraints();
    }
}
