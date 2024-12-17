<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
</head>
<body>
    <h1>Edit Student</h1>
    <form action="{{ route('students.update', $student->id) }}" method="POST">
        @csrf
        @method('PUT') <!-- This is necessary for PUT requests -->

        <label for="first_name">First Name:</label>
        <input type="text" name="first_name" value="{{ $student->first_name }}" required>
        <br><br>

        <label for="last_name">Last Name:</label>
        <input type="text" name="last_name" value="{{ $student->last_name }}" required>
        <br><br>

        <label for="age">Age:</label>
        <input type="number" name="age" value="{{ $student->age }}" required>
        <br><br>

        <label for="school">School:</label>
        <input type="text" name="school" value="{{ $student->school }}" required>
        <br><br>

        <button type="submit">Update Student</button>
    </form>
</body>
</html>
