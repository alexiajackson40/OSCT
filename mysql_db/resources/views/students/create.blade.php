<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Student</title>
</head>
<body>
    <h1>Create Student</h1>
    <form action="{{ route('students.store') }}" method="POST">
        @csrf
        <label for="first_name">First Name:</label>
        <input type="text" name="first_name" required>
        <br><br>

        <label for="last_name">Last Name:</label>
        <input type="text" name="last_name" required>
        <br><br>

        <label for="age">Age:</label>
        <input type="number" name="age" required>
        <br><br>

        <label for="school">School:</label>
        <input type="text" name="school" required>
        <br><br>

        <button type="submit">Create Student</button>
    </form>
</body>
</html>
