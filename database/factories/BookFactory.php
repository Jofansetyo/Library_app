<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'author' => $this->faker->name(),
            'year' => $this->faker->numberBetween(1990, 2024),
            'isbn' => $this->faker->isbn13(),
            'location' => 'Rak ' . $this->faker->numberBetween(1, 20) . '-' . $this->faker->randomLetter(),
        ];
    }
}