<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowerController;
use App\Http\Controllers\BorrowingController;
use App\Models\User;
use App\Models\Borrower;
use App\Models\Borrowing;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Books
Route::get('/books', [BookController::class, 'index'])->name('books.index');
Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
Route::post('/books', [BookController::class, 'store'])->name('books.store');
Route::get('/books/{id}/edit', [BookController::class, 'edit'])->name('books.edit');
Route::put('/books/{id}', [BookController::class, 'update'])->name('books.update');
Route::delete('/books/{id}', [BookController::class, 'destroy'])->name('books.destroy');

// Borrowers
Route::get('/borrowers', [BorrowerController::class, 'index'])->name('borrowers.index');
Route::get('/borrowers/create', [BorrowerController::class, 'create'])->name('borrowers.create');
Route::post('/borrowers', [BorrowerController::class, 'store'])->name('borrowers.store');
Route::get('/borrowers/{id}/edit', [BorrowerController::class, 'edit'])->name('borrowers.edit');
Route::put('/borrowers/{id}', [BorrowerController::class, 'update'])->name('borrowers.update');
Route::delete('/borrowers/{id}', [BorrowerController::class, 'destroy'])->name('borrowers.destroy');

// Borrowings
Route::get('/borrowings', [BorrowingController::class, 'index'])->name('borrowings.index');
Route::get('/borrowings/create', [BorrowingController::class, 'create'])->name('borrowings.create');
Route::post('/borrowings', [BorrowingController::class, 'store'])->name('borrowings.store');
Route::get('/borrowings/{id}/edit', [BorrowingController::class, 'edit'])->name('borrowings.edit');
Route::put('/borrowings/{id}', [BorrowingController::class, 'update'])->name('borrowings.update');
Route::delete('/borrowings/{id}', [BorrowingController::class, 'destroy'])->name('borrowings.destroy');

// Test One to One - User Profile
Route::get('/user-profile/{user_id}', function (string $id) {
    $user = User::find($id);
    echo $user->name;
    echo "<br>";
    echo $user->profile->address;
});

// Test One to Many - semua borrowing
Route::get('/borrowing', function () {
    $borrowing = Borrowing::all();
    foreach ($borrowing as $key => $value) {
        echo "Book: " . $value->book->title . ' | User:' . $value->borrower->name;
        echo "<br>";
    }
});

// Test One to Many - borrowing by borrower
Route::get('/borrower/{user_id}', function (string $id) {
    $borrower = Borrower::find($id);
    echo $borrower->name;
    echo "<br>";
    foreach ($borrower->borrowings as $key => $value) {
        echo "Book: " . $value->book->title;
        echo "<br>";
    }
});

// Test One to Many - book borrowers
Route::get('/book-borrow/{book_id}', function (string $id) {
    $book = \App\Models\Book::find($id);
    echo $book->title;
    echo "<br>";
    foreach ($book->borrowings as $key => $value) {
        echo "Borrower: " . $value->borrower->name;
        echo "<br>";
    }
});