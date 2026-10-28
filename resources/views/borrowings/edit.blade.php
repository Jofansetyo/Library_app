<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Borrowing</title>
</head>
<body>
    <h1>Edit Borrowing</h1>
    <form action="{{ route('borrowings.update', $borrowing->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="borrower_id">Borrower:</label>
            <select id="borrower_id" name="borrower_id">
                @foreach ($borrowers as $borrower)
                <option value="{{ $borrower->id }}" {{ $borrowing->borrower_id == $borrower->id ? 'selected' : '' }}>{{ $borrower->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="book_id">Book:</label>
            <select id="book_id" name="book_id">
                @foreach ($books as $book)
                <option value="{{ $book->id }}" {{ $borrowing->book_id == $book->id ? 'selected' : '' }}>{{ $book->title }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="borrow_date">Borrow Date:</label>
            <input type="date" id="borrow_date" name="borrow_date" value="{{ $borrowing->borrow_date }}">
        </div>
        <div>
            <label for="return_date">Return Date:</label>
            <input type="date" id="return_date" name="return_date" value="{{ $borrowing->return_date }}">
        </div>
        <div>
            <button type="submit">Update</button>
        </div>
    </form>
</body>
</html>