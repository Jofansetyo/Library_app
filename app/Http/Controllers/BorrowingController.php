<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use App\Models\Borrower;
use App\Models\Book;
use Illuminate\Http\Request;

class BorrowingController extends Controller
{
    public function index()
    {
        $borrowings = Borrowing::with(['borrower', 'book'])->get();
        return view('borrowings.index', compact('borrowings'));
    }

    public function create()
    {
        $borrowers = Borrower::all();
        $books = Book::all();

        return view('borrowings.create', compact('borrowers', 'books'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'borrower_id' => 'required',
            'book_id'     => 'required',
            'borrow_date' => 'required',
            'return_date' => 'nullable',
        ]);

        Borrowing::create($request->all());

        return redirect()->route('borrowings.index');
    }

    public function edit($id)
    {
        $borrowing = Borrowing::findOrFail($id);
        $borrowers = Borrower::all();
        $books = Book::all();

        return view('borrowings.edit', compact('borrowing', 'borrowers', 'books'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'borrower_id' => 'required',
            'book_id'     => 'required',
            'borrow_date' => 'required',
            'return_date' => 'nullable',
        ]);

        $borrowing = Borrowing::findOrFail($id);
        $borrowing->update($request->all());

        return redirect()->route('borrowings.index');
    }

    public function destroy($id)
    {
        $borrowing = Borrowing::findOrFail($id);
        $borrowing->delete();

        return redirect()->route('borrowings.index');
    }
}