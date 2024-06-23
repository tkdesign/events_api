<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Testimonial>
 */
class TestimonialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $images = [
            "/images/testimonials/1719150430.png",
            "/images/testimonials/1719150447.png",
            "/images/testimonials/1719150468.png",
            "/images/testimonials/1719150534.png",
            "/images/testimonials/1719150550.png",
            "/images/testimonials/1719150574.png",
            "/images/testimonials/1719150588.png",
            "/images/testimonials/1719150604.png",
            "/images/testimonials/1719150634.png",
            "/images/testimonials/1719150647.png",
            "/images/testimonials/1719150665.png",
            "/images/testimonials/1719150677.png",
            "/images/testimonials/1719150691.png",
            "/images/testimonials/1719150703.png",
            "/images/testimonials/1719150716.png"
        ];

        $image_index = $this->faker->numberBetween(0, 14);

        return [
            //
            'desc' => $this->faker->sentence(),
            'rating' => $this->faker->numberBetween(1, 5),
            'image' => $images[$image_index],
            'thumbnail' => $images[$image_index],
//            'image' => $this->faker->imageUrl(),
//            'thumbnail' => $this->faker->imageUrl(),
            'user_id' => $this->faker->numberBetween(2, 15),
            'event_id' => $this->faker->numberBetween(1, 3),
            'visible' => '1',
            'position' => $this->faker->numberBetween(1, 15)
        ];
    }
}
