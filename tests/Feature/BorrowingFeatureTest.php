<?php

namespace Tests\Feature;

use App\Models\Borrowing;
use App\Models\Borrower;
use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BorrowingFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_data()
    {
        $response = $this->get('/borrowings');
        $response->assertStatus(200);
    }

    public function test_stores_data()
    {
        $borrower = Borrower::factory()->create();
        $book = Book::factory()->create();

        $data = [
            'borrower_id' => $borrower->id,
            'book_id'     => $book->id,
            'borrow_date' => '2024-01-01',
            'return_date' => null,
        ];

        $response = $this->post('/borrowings', $data);
        $response->assertStatus(302);
        $this->assertDatabaseHas('borrowings', [
            'borrower_id' => $borrower->id,
            'book_id'     => $book->id,
            'borrow_date' => '2024-01-01',
        ]);
    }

    public function test_edit_data()
    {
        $borrowing = Borrowing::factory()->create();
        $response = $this->get("/borrowings/{$borrowing->id}/edit");
        $response->assertStatus(200);
        $borrowing->delete();
    }

    public function test_update_data()
    {
        $borrowing = Borrowing::factory()->create();
        $borrower = Borrower::factory()->create();
        $book = Book::factory()->create();

        $updatedData = [
            'borrower_id' => $borrower->id,
            'book_id'     => $book->id,
            'borrow_date' => '2024-06-01',
            'return_date' => '2024-06-10',
        ];

        $response = $this->put("/borrowings/{$borrowing->id}", $updatedData);
        $response->assertStatus(302);
        $this->assertDatabaseHas('borrowings', $updatedData);
        $borrowing->delete();
    }

    public function test_destroy_data()
    {
        $borrowing = Borrowing::factory()->create();
        $response = $this->delete("/borrowings/{$borrowing->id}");
        $response->assertStatus(302);
        $this->assertDatabaseMissing('borrowings', ['id' => $borrowing->id]);
        $borrowing->delete();
    }
}