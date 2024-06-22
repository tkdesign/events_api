<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $banners = [
            [
                "title" => "nConnect conference 2024",
                "content" => "            <h6 class=\"text-h6 mb-5 pl-1\">1 July 2024, <span>Nitra, Slovakia</span></h6>
            <h1 class=\"text-h1 mb-5\">
              <small class=\"d-block p-2 h1-small pl-1\">CONFERENCE</small>
              WEB DEV 2024</h1>",
                "image" => "https://via.placeholder.com/1920x1080",
                "thumbnail" => "https://via.placeholder.com/300x200",
                "visible" => 1,
                "position" => 1,
                "color" => "#4CAF50",
                "text_color" => "#FFFFFF",
                "event_id" => 3,
            ],
            [
                "title" => "Masterclass Laravel API + Vue",
                "content" => "            <h6 class=\"text-h6 mb-5 pl-1\">1 July 2024, <span>Nitra, Slovakia</span></h6>
            <h1 class=\"text-h1 mb-5\">
              <small class=\"d-block p-2 h1-small pl-1\">MASTERCLASS</small>
              LARAVEL API + VUE</h1>",
                "image" => "https://via.placeholder.com/1920x1080",
                "thumbnail" => "https://via.placeholder.com/300x200",
                "visible" => 1,
                "position" => 2,
                "color" => "#2196F3",
                "text_color" => "#FFFFFF",
                "event_id" => 3,
            ],
        ];

        Schema::disableForeignKeyConstraints();
        Banner::truncate();

        foreach ($banners as $banner) {
            Banner::create($banner);
        }

        Schema::enableForeignKeyConstraints();
    }
}
