<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Patient - Operación Salud Colima Tamizaje</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

<div class="container">
    <h1>Add New Patient</h1>

    <form action="{{ url('/patients') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="no_sol">No. SOL</label>
            <input type="text" class="form-control" name="no_sol" required>
        </div>

        <div class="form-group">
            <label for="patient_name">Name</label>
            <input type="text" class="form-control" name="patient_name" required>
        </div>

        <div class="form-group">
            <label for="gender">Gender</label>
            <select name="gender" class="form-control" required>
                <option value="M">Male</option>
                <option value="F">Female</option>
                <option value="Other">Other</option>
            </select>
        </div>

        <!-- Add other fields like age, school, glucose, etc., following the pattern above -->

        <button type="submit" class="btn btn-primary">Add Patient</button>
    </form>
</div>

</body>
</html>
