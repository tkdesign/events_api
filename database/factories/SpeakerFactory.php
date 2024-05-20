<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Speaker>
 */
class SpeakerFactory extends Factory
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
            'titul' => $this->faker->title(),
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'company' => $this->faker->company(),
            'occupation' => $this->faker->jobTitle(),
            'short_desc' => $this->faker->sentence(),
            'desc' => $this->faker->paragraph(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'facebook' => $this->faker->url(),
            'instagram' => $this->faker->url(),
            'linkedin' => $this->faker->url(),
            'image' => $this->faker->imageUrl(),
            'thumbnail' => $this->faker->imageUrl(),
        ];
    }
}
