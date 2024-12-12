<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
           'title' => $this->faker->unique()->sentence(4, true),
            'slug' => $this->faker->unique()->slug(),
           'publication' => $this->faker->dateTime(),
           'summary' => $this->faker->sentences(5, true),
           'page' => $this->faker->numberBetween(100,1000),
           'category_id' => $this->faker->numberBetween(1,3),
           'language_id' => $this->faker->numberBetween(1,5),
           'publishing_id' => $this->faker->numberBetween(1,10),
            'cover' => $this->faker->imageUrl(),
        ];
    }
}
