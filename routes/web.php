<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Borrower;
use App\Models\Borrowing;

// Landing and authentication
Route::get('/', function () {
    return response()->file(public_path('landing-showcase.html'));
})->name('landing');

Route::get('/catalog', function () {
    return view('catalog.index', ['books' => Book::query()->latest()->get()]);
})->name('catalog.index');

Route::get('/login', function () {
    if (Auth::check()) {
        return redirect()->route('books.index');
    }

    return view('auth.login');
})->name('login');

Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required', 'string'],
    ]);

    if (Auth::attempt($credentials, $request->boolean('remember'))) {
        $request->session()->regenerate();

        return redirect()->intended(route('books.index'));
    }

    return back()->withErrors([
        'email' => 'Email atau password tidak sesuai.',
    ])->onlyInput('email');
})->name('login.store');

Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('landing');
})->name('logout');

Route::get('/book', function () {
    $books = Book::all();
    return view('books.index', ['books' => $books]);
})->name('books.index');

Route::get('/book/create', function () {
    return view('books.create');
})->name('books.create');

Route::post('/book', function (Request $request) {
    $validated = $request->validate([
        'title' => 'required',
        'author' => 'required',
        'year' => 'required|numeric',
        'isbn' => 'nullable',
        'location' => 'nullable',
    ]);

    Book::create($validated);

    return redirect()->route('books.index');
})->name('books.store');

Route::get('/book/{id}/edit', function ($id) {
    $book = Book::findOrFail($id);
    return view('books.edit', ['book' => $book]);
})->name('books.edit');

Route::put('/book/{id}', function (Request $request, $id) {
    $validated = $request->validate([
        'title' => 'required',
        'author' => 'required',
        'year' => 'required|numeric',
        'isbn' => 'nullable',
        'location' => 'nullable',
    ]);

    $book = Book::findOrFail($id);
    $book->update($validated);

    return redirect()->route('books.index');
})->name('books.update');

Route::delete('/book/{id}', function ($id) {
    $book = Book::findOrFail($id);

    if ($book->borrowings()->whereNull('actual_return_date')->exists()) {
        return back()->withErrors([
            'delete' => 'Buku tidak dapat dihapus karena masih dalam peminjaman aktif.',
        ]);
    }

    $book->delete();

    return redirect()->route('books.index');
})->name('books.destroy');

Route::get('/borrower', function () {
    $borrowers = Borrower::all();
    return view('borrowers.index', ['borrowers' => $borrowers]);
})->name('borrowers.index');

Route::get('/borrower/create', function () {
    return view('borrowers.create');
})->name('borrowers.create');

Route::post('/borrower', function (Request $request) {
    $validated = $request->validate([
        'name' => 'required',
        'phone' => 'nullable',
        'address' => 'nullable',
    ]);

    Borrower::create($validated);

    return redirect()->route('borrowers.index');
})->name('borrowers.store');

Route::get('/borrower/{id}/edit', function ($id) {
    $borrower = Borrower::findOrFail($id);
    return view('borrowers.edit', ['borrower' => $borrower]);
})->name('borrowers.edit');

Route::put('/borrower/{id}', function (Request $request, $id) {
    $validated = $request->validate([
        'name' => 'required',
        'phone' => 'nullable',
        'address' => 'nullable',
    ]);

    $borrower = Borrower::findOrFail($id);
    $borrower->update($validated);

    return redirect()->route('borrowers.index');
})->name('borrowers.update');

Route::delete('/borrower/{id}', function ($id) {
    $borrower = Borrower::findOrFail($id);

    if ($borrower->borrowings()->whereNull('actual_return_date')->exists()) {
        return back()->withErrors([
            'delete' => 'Peminjam tidak dapat dihapus karena masih memiliki peminjaman aktif.',
        ]);
    }

    $borrower->delete();

    return redirect()->route('borrowers.index');
})->name('borrowers.destroy');

Route::get('/borrowing', function () {
    $borrowings = Borrowing::all();
    return view('borrowings.index', ['borrowings' => $borrowings]);
})->name('borrowings.index');

Route::get('/borrowing/create', function () {
    $borrowers = Borrower::all();
    $books = Book::all();
    return view('borrowings.create', ['borrowers' => $borrowers, 'books' => $books]);
})->name('borrowings.create');

Route::post('/borrowing', function (Request $request) {
    $validated = $request->validate([
        'borrower_id' => 'required|exists:borrowers,id',
        'book_id' => 'required|exists:books,id',
        'borrow_date' => 'required|date',
        'return_date' => 'required|date|after_or_equal:borrow_date',
    ]);

    $bookIsBorrowed = Borrowing::where('book_id', $validated['book_id'])
        ->whereNull('actual_return_date')
        ->exists();

    if ($bookIsBorrowed) {
        return back()->withErrors([
            'book_id' => 'Buku ini sedang dipinjam dan belum dikembalikan.',
        ])->withInput();
    }

    Borrowing::create($validated);

    return redirect()->route('borrowings.index');
})->name('borrowings.store');

Route::get('/borrowing/{id}/edit', function ($id) {
    $borrowing = Borrowing::findOrFail($id);
    $borrowers = Borrower::all();
    $books = Book::all();
    return view('borrowings.edit', [
        'borrowing' => $borrowing,
        'borrowers' => $borrowers,
        'books' => $books,
    ]);
})->name('borrowings.edit');

Route::put('/borrowing/{id}', function (Request $request, $id) {
    $validated = $request->validate([
        'borrower_id' => 'required|exists:borrowers,id',
        'book_id' => 'required|exists:books,id',
        'borrow_date' => 'required|date',
        'return_date' => 'required|date|after_or_equal:borrow_date',
        'actual_return_date' => 'nullable|date|after_or_equal:borrow_date',
    ]);

    $borrowing = Borrowing::findOrFail($id);

    $bookIsBorrowed = Borrowing::where('book_id', $validated['book_id'])
        ->whereNull('actual_return_date')
        ->where('id', '!=', $borrowing->id)
        ->exists();

    if ($bookIsBorrowed) {
        return back()->withErrors([
            'book_id' => 'Buku ini sedang dipinjam pada transaksi aktif lain.',
        ])->withInput();
    }

    $borrowing->update($validated);

    return redirect()->route('borrowings.index');
})->name('borrowings.update');

Route::delete('/borrowing/{id}', function ($id) {
    $borrowing = Borrowing::findOrFail($id);
    $borrowing->delete();

    return redirect()->route('borrowings.index');
})->name('borrowings.destroy');