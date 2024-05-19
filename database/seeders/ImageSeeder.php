<?php

namespace Database\Seeders;

use App\Models\Image;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $images = [
            [

                'title' => 'Image 1',
                'image' => 'https://picsum.photos/1024/768?image=15',
                'thumbnail' => 'https://picsum.photos/500/300?image=15',
                'gallery_id' => 1,
            ],

            [

                'title' => 'Image 2',
                'image' => 'https://picsum.photos/1024/768?image=16',
                'thumbnail' => 'https://picsum.photos/500/300?image=16',
                'gallery_id' => 1,
            ],

            [

                'title' => 'Image 3',
                'image' => 'https://picsum.photos/1024/768?image=17',
                'thumbnail' => 'https://picsum.photos/500/300?image=17',
                'gallery_id' => 1,
            ],

            [

                'title' => 'Image 4',
                'image' => 'https://picsum.photos/1024/768?image=18',
                'thumbnail' => 'https://picsum.photos/500/300?image=18',
                'gallery_id' => 1,
            ],

            [

                'title' => 'Image 5',
                'image' => 'https://picsum.photos/1024/768?image=19',
                'thumbnail' => 'https://picsum.photos/500/300?image=19',
                'gallery_id' => 1,
            ],

            [

                'title' => 'Image 6',
                'image' => 'https://picsum.photos/1024/768?image=20',
                'thumbnail' => 'https://picsum.photos/500/300?image=20',
                'gallery_id' => 1,
            ],

            [

                'title' => 'Image 7',
                'image' => 'https://picsum.photos/1024/768?image=21',
                'thumbnail' => 'https://picsum.photos/500/300?image=21',
                'gallery_id' => 1,
            ],

            [

                'title' => 'Image 8',
                'image' => 'https://picsum.photos/1024/768?image=22',
                'thumbnail' => 'https://picsum.photos/500/300?image=22',
                'gallery_id' => 1,
            ],

            [

                'title' => 'Image 9',
                'image' => 'https://picsum.photos/1024/768?image=23',
                'thumbnail' => 'https://picsum.photos/500/300?image=23',
                'gallery_id' => 1,
            ],

            [

                'title' => 'Image 10',
                'image' => 'https://picsum.photos/1024/768?image=24',
                'thumbnail' => 'https://picsum.photos/500/300?image=24',
                'gallery_id' => 1,
            ],

            [

                'title' => 'Image 11',
                'image' => 'https://picsum.photos/1024/768?image=25',
                'thumbnail' => 'https://picsum.photos/500/300?image=25',
                'gallery_id' => 1,
            ],

            [

                'title' => 'Image 12',
                'image' => 'https://picsum.photos/1024/768?image=26',
                'thumbnail' => 'https://picsum.photos/500/300?image=26',
                'gallery_id' => 1,
            ],

            [

                'title' => 'Image 13',
                'image' => 'https://picsum.photos/1024/768?image=27',
                'thumbnail' => 'https://picsum.photos/500/300?image=27',
                'gallery_id' => 1,
            ],

            [

                'title' => 'Image 14',
                'image' => 'https://picsum.photos/1024/768?image=28',
                'thumbnail' => 'https://picsum.photos/500/300?image=28',
                'gallery_id' => 1,
            ],

            [

                'title' => 'Image 15',
                'image' => 'https://picsum.photos/1024/768?image=29',
                'thumbnail' => 'https://picsum.photos/500/300?image=29',
                'gallery_id' => 1,
            ],

            [

                'title' => 'Image 16',
                'image' => 'https://picsum.photos/1024/768?image=30',
                'thumbnail' => 'https://picsum.photos/500/300?image=30',
                'gallery_id' => 1,
            ],

            [

                'title' => 'Image 17',
                'image' => 'https://picsum.photos/1024/768?image=31',
                'thumbnail' => 'https://picsum.photos/500/300?image=31',
                'gallery_id' => 1,
            ],

            [

                'title' => 'Image 18',
                'image' => 'https://picsum.photos/1024/768?image=32',
                'thumbnail' => 'https://picsum.photos/500/300?image=32',
                'gallery_id' => 1,
            ],
            [

                'title' => 'Image 19',
                'image' => 'https://picsum.photos/1024/768?image=33',
                'thumbnail' => 'https://picsum.photos/500/300?image=33',
                'gallery_id' => 1,
            ],
            [

                'title' => 'Image 20',
                'image' => 'https://picsum.photos/1024/768?image=34',
                'thumbnail' => 'https://picsum.photos/500/300?image=34',
                'gallery_id' => 2,
            ],
            [

                'title' => 'Image 21',
                'image' => 'https://picsum.photos/1024/768?image=35',
                'thumbnail' => 'https://picsum.photos/500/300?image=35',
                'gallery_id' => 2,
            ],
            [

                'title' => 'Image 22',
                'image' => 'https://picsum.photos/1024/768?image=36',
                'thumbnail' => 'https://picsum.photos/500/300?image=36',
                'gallery_id' => 2,
            ],
            [

                'title' => 'Image 23',
                'image' => 'https://picsum.photos/1024/768?image=37',
                'thumbnail' => 'https://picsum.photos/500/300?image=37',
                'gallery_id' => 2,
            ],
            [

                'title' => 'Image 24',
                'image' => 'https://picsum.photos/1024/768?image=38',
                'thumbnail' => 'https://picsum.photos/500/300?image=38',
                'gallery_id' => 2,
            ],
            [

                'title' => 'Image 25',
                'image' => 'https://picsum.photos/1024/768?image=39',
                'thumbnail' => 'https://picsum.photos/500/300?image=39',
                'gallery_id' => 2,
            ],
            [

                'title' => 'Image 26',
                'image' => 'https://picsum.photos/1024/768?image=40',
                'thumbnail' => 'https://picsum.photos/500/300?image=40',
                'gallery_id' => 2,
            ],
            [

                'title' => 'Image 27',
                'image' => 'https://picsum.photos/1024/768?image=41',
                'thumbnail' => 'https://picsum.photos/500/300?image=41',
                'gallery_id' => 2,
            ],
            [

                'title' => 'Image 28',
                'image' => 'https://picsum.photos/1024/768?image=42',
                'thumbnail' => 'https://picsum.photos/500/300?image=42',
                'gallery_id' => 2,
            ],
            [

                'title' => 'Image 29',
                'image' => 'https://picsum.photos/1024/768?image=43',
                'thumbnail' => 'https://picsum.photos/500/300?image=43',
                'gallery_id' => 2,
            ],
            [

                'title' => 'Image 30',
                'image' => 'https://picsum.photos/1024/768?image=44',
                'thumbnail' => 'https://picsum.photos/500/300?image=44',
                'gallery_id' => 3,
            ],
            [

                'title' => 'Image 31',
                'image' => 'https://picsum.photos/1024/768?image=45',
                'thumbnail' => 'https://picsum.photos/500/300?image=45',
                'gallery_id' => 3,
            ],
            [

                'title' => 'Image 32',
                'image' => 'https://picsum.photos/1024/768?image=46',
                'thumbnail' => 'https://picsum.photos/500/300?image=46',
                'gallery_id' => 3,
            ],
            [

                'title' => 'Image 33',
                'image' => 'https://picsum.photos/1024/768?image=47',
                'thumbnail' => 'https://picsum.photos/500/300?image=47',
                'gallery_id' => 3,
            ],
            [

                'title' => 'Image 34',
                'image' => 'https://picsum.photos/1024/768?image=48',
                'thumbnail' => 'https://picsum.photos/500/300?image=48',
                'gallery_id' => 3,
            ],
            [

                'title' => 'Image 35',
                'image' => 'https://picsum.photos/1024/768?image=49',
                'thumbnail' => 'https://picsum.photos/500/300?image=49',
                'gallery_id' => 3,
            ],
            [

                'title' => 'Image 36',
                'image' => 'https://picsum.photos/1024/768?image=50',
                'thumbnail' => 'https://picsum.photos/500/300?image=50',
                'gallery_id' => 3,
            ],
            [

                'title' => 'Image 37',
                'image' => 'https://picsum.photos/1024/768?image=51',
                'thumbnail' => 'https://picsum.photos/500/300?image=51',
                'gallery_id' => 3,
            ],
            [

                'title' => 'Image 38',
                'image' => 'https://picsum.photos/1024/768?image=52',
                'thumbnail' => 'https://picsum.photos/500/300?image=52',
                'gallery_id' => 3,
            ],
            [

                'title' => 'Image 39',
                'image' => 'https://picsum.photos/1024/768?image=53',
                'thumbnail' => 'https://picsum.photos/500/300?image=53',
                'gallery_id' => 3,
            ],
            [

                'title' => 'Image 40',
                'image' => 'https://picsum.photos/1024/768?image=54',
                'thumbnail' => 'https://picsum.photos/500/300?image=54',
                'gallery_id' => 3,
            ],
        ];

        Schema::disableForeignKeyConstraints();
        Image::truncate();

        $i = 1;
        foreach ($images as $image) {
            $image['visible'] = true;
            $image['position'] = $i++;
            Image::create($image);
        }

        Schema::enableForeignKeyConstraints();
    }
}
