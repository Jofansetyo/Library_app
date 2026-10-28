<?php

namespace Tests\Feature;

use App\Models\Borrower;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BorrowerFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_data()
    {
        $response = $this->get('/borrowers');
        $response->assertStatus(200);
    }

    public function test_stores_data()
    {
        $borrower = Borrower::factory()->create();
        $response = $this->post('/borrowers', $borrower->toArray());
        $response->assertStatus(302);
        $this->assertDatabaseHas('borrowers', [
            'name'  => $borrower->name,
            'email' => $borrower->email,
            'phone' => $borrower->phone,
        ]);
        $borrower->delete();
    }

    public function test_edit_data()
    {
        $borrower = Borrower::factory()->create();
        $response = $this->get("/borrowers/{$borrower->id}/edit");
        $response->assertStatus(200);
        $borrower->delete();
    }

    public function test_update_data()
    {
        $borrower = Borrower::factory()->create();

        $updatedData = [
            'name'  => 'Nama Update',
            'email' => 'update@email.com',
            'phone' => '08123456789',
        ];

        $response = $this->put("/borrowers/{$borrower->id}", $updatedData);
        $response->assertStatus(302);
        $this->assertDatabaseHas('borrowers', $updatedData);
        $borrower->delete();
    }

    public function test_destroy_data()
    {
        $borrower = Borrower::factory()->create();
        $response = $this->delete("/borrowers/{$borrower->id}");
        $response->assertStatus(302);
        $this->assertDatabaseMissing('borrowers', ['id' => $borrower->id]);
        $borrower->delete();
    }
}