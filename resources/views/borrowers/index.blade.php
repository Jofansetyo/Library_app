<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrower List</title>
</head>
<body>
    <h1>Borrower List</h1>
    <a href="{{ route('borrowers.create') }}">Add New Borrower</a>
    <table border="1">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($borrowers as $borrower)
            <tr>
                <td>{{ $borrower->name }}</td>
                <td>{{ $borrower->email }}</td>
                <td>{{ $borrower->phone }}</td>
                <td>
                    <a href="{{ route('borrowers.edit', $borrower->id) }}">Edit</a>
                    <form action="{{ route('borrowers.destroy', $borrower->id) }}" method="POST" style="display: inline;">
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