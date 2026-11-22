<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Borrower;
use Illuminate\Database\Eloquent\Factories\Factory;

class BorrowingFactory extends Factory
{
    public function definition(): array
    {
        $borrowDate = $this->faker->dateTimeBetween('-30 days', '-5 days');
        $returnDate = (clone $borrowDate)->modify('+7 days');

        // 60% kemungkinan sudah dikembalikan
        $actualReturnDate = $this->faker->boolean(60)
            ? $this->faker->dateTimeBetween($borrowDate, '+10 days')
            : null;

        return [
            'borrower_id' => Borrower::inRandomOrder()->first()->id,
            'book_id' => Book::inRandomOrder()->first()->id,
            'borrow_date' => $borrowDate->format('Y-m-d'),
            'return_date' => $returnDate->format('Y-m-d'),
            'actual_return_date' => $actualReturnDate ? $actualReturnDate->format('Y-m-d') : null,
        ];
    }
}