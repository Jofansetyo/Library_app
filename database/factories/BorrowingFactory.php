<?php

namespace Database\Factories;

use App\Models\Borrower;
use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

class BorrowingFactory extends Factory
{
    public function definition(): array
    {
        return [
            'borrower_id' => Borrower::factory(),
            'book_id'     => Book::factory(),
            'borrow_date' => $this->faker->date(),
            'return_date' => null,
        ];
    }
}