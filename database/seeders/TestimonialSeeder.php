<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Testimonial;
use Database\Factories\TestimonialFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
/*        $testimonials = [
            [
                'desc' => 'This is the best event i had ever joined. Most exiting this is speakers are so exprienced & helpfull. Also the decoretion was also very good. In one word \'Just Awesome\'',
                'rating' => '5',
                'image' => '../src/assets/images/testimonial/1.jpg',
                'thumbnail' => '../src/assets/images/testimonial/thumbs/1.jpg',
                'user_id' => '2',
            ],
            [
                'desc' => 'This is the best event i had ever joined. Most exiting this is speakers are so exprienced & helpfull. Also the decoretion was also very good. In one word \'Just Awesome\'',
                'rating' => '5',
                'image' => '../src/assets/images/testimonial/2.jpg',
                'thumbnail' => '../src/assets/images/testimonial/thumbs/2.jpg',
                'user_id' => '3',
            ],
            [
                'desc' => 'This is the best event i had ever joined. Most exiting this is speakers are so exprienced & helpfull. Also the decoretion was also very good. In one word \'Just Awesome\'',
                'rating' => '5',
                'image' => '../src/assets/images/testimonial/3.jpg',
                'thumbnail' => '../src/assets/images/testimonial/thumbs/3.jpg',
                'user_id' => '4',
            ],
            [
                'desc' => 'This is the best event i had ever joined. Most exiting this is speakers are so exprienced & helpfull. Also the decoretion was also very good. In one word \'Just Awesome\'',
                'rating' => '5',
                'image' => '../src/assets/images/testimonial/4.jpg',
                'thumbnail' => '../src/assets/images/testimonial/thumbs/4.jpg',
                'user_id' => '5',
            ],
            [
                'desc' => 'This is the best event i had ever joined. Most exiting this is speakers are so exprienced & helpfull. Also the decoretion was also very good. In one word \'Just Awesome\'',
                'rating' => '5',
                'image' => '../src/assets/images/testimonial/5.jpg',
                'thumbnail' => '../src/assets/images/testimonial/thumbs/5.jpg',
                'user_id' => '6',
            ],
            [
                'desc' => 'This is the best event i had ever joined. Most exiting this is speakers are so exprienced & helpfull. Also the decoretion was also very good. In one word \'Just Awesome\'',
                'rating' => '5',
                'image' => '../src/assets/images/testimonial/6.jpg',
                'thumbnail' => '../src/assets/images/testimonial/thumbs/6.jpg',
                'user_id' => '7',
            ],
            [
                'desc' => 'This is the best event i had ever joined. Most exiting this is speakers are so exprienced & helpfull. Also the decoretion was also very good. In one word \'Just Awesome\'',
                'rating' => '5',
                'image' => '../src/assets/images/testimonial/7.jpg',
                'thumbnail' => '../src/assets/images/testimonial/thumbs/7.jpg',
                'user_id' => '8',
            ],
            [
                'desc' => 'This is the best event i had ever joined. Most exiting this is speakers are so exprienced & helpfull. Also the decoretion was also very good. In one word \'Just Awesome\'',
                'rating' => '5',
                'image' => '../src/assets/images/testimonial/8.jpg',
                'thumbnail' => '../src/assets/images/testimonial/thumbs/8.jpg',
                'user_id' => '9',
            ],
            [
                'desc' => 'This is the best event i had ever joined. Most exiting this is speakers are so exprienced & helpfull. Also the decoretion was also very good. In one word \'Just Awesome\'',
                'rating' => '5',
                'image' => '../src/assets/images/testimonial/9.jpg',
                'thumbnail' => '../src/assets/images/testimonial/thumbs/9.jpg',
                'user_id' => '10',
            ],
            [
                'desc' => 'This is the best event i had ever joined. Most exiting this is speakers are so exprienced & helpfull. Also the decoretion was also very good. In one word \'Just Awesome\'',
                'rating' => '5',
                'image' => '../src/assets/images/testimonial/10.jpg',
                'thumbnail' => '../src/assets/images/testimonial/thumbs/10.jpg',
                'user_id' => '11',
            ]
        ];*/

        Schema::disableForeignKeyConstraints();
        Testimonial::truncate();

//        $event = Event::where('is_current', true)->first();
//        if ($event) {
//            $i = 1;
//            foreach ($testimonials as $testimonial) {
//                $testimonial['event_id'] = $event->event_id;
//                $testimonial['visible'] = 1;
//                $testimonial['position'] = $i++;
//                Testimonial::create($testimonial);
//            }
//        }

        TestimonialFactory::times(15)->create();

        Schema::enableForeignKeyConstraints();
    }
}
