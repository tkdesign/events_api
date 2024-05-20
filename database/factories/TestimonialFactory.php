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
        return [
            //
            'desc' => $this->faker->sentence(),
            'rating' => $this->faker->numberBetween(1, 5),
            'image' => $this->faker->imageUrl(),
            'thumbnail' => $this->faker->imageUrl(),
            'user_id' => $this->faker->numberBetween(2, 15),
            'event_id' => $this->faker->numberBetween(1, 3),
            'visible' => '1',
            'position' => $this->faker->numberBetween(1, 10)
        ];
    }
}
