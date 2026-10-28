<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Borrower</title>
</head>
<body>
    <h1>Edit Borrower</h1>
    <form action="{{ route('borrowers.update', $borrower->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="{{ $borrower->name }}">
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" value="{{ $borrower->email }}">
        </div>
        <div>
            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" value="{{ $borrower->phone }}">
        </div>
        <div>
            <button type="submit">Update</button>
        </div>
    </form>
</body>
</html>