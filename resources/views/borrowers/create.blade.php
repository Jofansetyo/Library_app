<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Borrower</title>
</head>
<body>
    <h1>Add New Borrower</h1>
    <form action="{{ route('borrowers.store') }}" method="POST">
        @csrf
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="">
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" value="">
        </div>
        <div>
            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" value="">
        </div>
        <div>
            <button type="submit">Add</button>
        </div>
    </form>
</body>
</html>