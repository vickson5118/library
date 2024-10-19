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
           'publication' => $this->faker->dateTime(),
           'summary' => $this->faker->sentences(5, true),
           'pages' => $this->faker->numberBetween(100,1000),
           'categorie_id' => $this->faker->numberBetween(1,3),
           'language_id' => $this->faker->numberBetween(1,5),
           'editor_id' => $this->faker->numberBetween(1,10),
        ]; 
    }
}
