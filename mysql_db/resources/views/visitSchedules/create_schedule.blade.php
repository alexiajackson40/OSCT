<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Visit Schedule</title>
</head>
<body>
    <h1>Create Visit Schedule</h1>
    <form action="{{ route('visitSchedules.store', $student->id) }}" method="POST">
        @csrf

        <!-- Form fields -->
        <label for="level">Level:</label>
        <input type="text" name="level" required>
        <br><br>

        <label for="shift">Shift:</label>
        <input type="text" name="shift" required>
        <br><br>

        <label for="school_code">School Code:</label>
        <input type="text" name="school_code" required>
        <br><br>

        <label for="school_name">School Name:</label>
        <input type="text" name="school_name" required>
        <br><br>

        <label for="municipality">Municipality:</label>
        <input type="text" name="municipality" required>
        <br><br>

        <label for="location">Location:</label>
        <input type="text" name="location" required>
        <br><br>

        <label for="address">Address:</label>
        <input type="text" name="address" required>
        <br><br>

        <label for="total_students">Total Students:</label>
        <input type="number" name="total_students" required>
        <br><br>

        <label for="visit_date">Visit Date:</label>
        <input type="date" name="visit_date" required>
        <br><br>

        <button type="submit">Save Visit Schedule</button>
    </form>
</body>
</html>
