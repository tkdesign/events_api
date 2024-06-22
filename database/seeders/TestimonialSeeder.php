<?php

namespace Database\Seeders;

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
