<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Borrowing</title>
</head>
<body>
    <h1>Add New Borrowing</h1>
    <form action="{{ route('borrowings.store') }}" method="POST">
        @csrf
        <div>
            <label for="borrower_id">Borrower:</label>
            <select id="borrower_id" name="borrower_id">
                @foreach ($borrowers as $borrower)
                <option value="{{ $borrower->id }}">{{ $borrower->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="book_id">Book:</label>
            <select id="book_id" name="book_id">
                @foreach ($books as $book)
                <option value="{{ $book->id }}">{{ $book->title }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="borrow_date">Borrow Date:</label>
            <input type="date" id="borrow_date" name="borrow_date">
        </div>
        <div>
            <label for="return_date">Return Date:</label>
            <input type="date" id="return_date" name="return_date">
        </div>
        <div>
            <button type="submit">Add</button>
        </div>
    </form>
</body>
</html>