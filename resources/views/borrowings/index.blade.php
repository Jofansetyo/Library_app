<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrowing List</title>
</head>
<body>
    <h1>Borrowing List</h1>
    <a href="{{ route('borrowings.create') }}">Add New Borrowing</a>
    <table border="1">
        <thead>
            <tr>
                <th>Borrower</th>
                <th>Book</th>
                <th>Borrow Date</th>
                <th>Return Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($borrowings as $borrowing)
            <tr>
                <td>{{ $borrowing->borrower->name }}</td>
                <td>{{ $borrowing->book->title }}</td>
                <td>{{ $borrowing->borrow_date }}</td>
                <td>{{ $borrowing->return_date ?? '-' }}</td>
                <td>
                    <a href="{{ route('borrowings.edit', $borrowing->id) }}">Edit</a>
                    <form action="{{ route('borrowings.destroy', $borrowing->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>