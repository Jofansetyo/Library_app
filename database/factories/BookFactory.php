<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title'  => $this->faker->name(),
            'author' => $this->faker->name(),
            'year'   => $this->faker->randomElement([2000, 2001, 2002]),
        ];
    }
}