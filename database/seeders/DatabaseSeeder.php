<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Borrower;
use App\Models\Borrowing;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Book::factory(15)->create();
        Borrower::factory(10)->create();
        Borrowing::factory(20)->create();
    }
}