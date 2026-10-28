<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        \App\Models\User::factory(10)->create();
        \App\Models\Book::factory(10)->create();
        \App\Models\UserProfile::factory(10)->create();
        \App\Models\Borrower::factory(10)->create();
        \App\Models\Borrowing::factory(10)->create();
    }
}