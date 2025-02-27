<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Patient - Operación Salud Colima Tamizaje</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

<div class="container">
    <h1>Edit Patient</h1>

    <form action="{{ url('/patients/' . $patient->id) }}" method="POST">
        @csrf
        @method('PUT') <!-- This tells Laravel to use a PUT request to update the record -->
        
        <div class="form-group">
            <label for="no_sol">No. SOL</label>
            <input type="text" class="form-control" name="no_sol" value="{{ $patient->no_sol }}" required>
        </div>

        <div class="form-group">
            <label for="patient_name">Name</label>
            <input type="text" class="form-control" name="patient_name" value="{{ $patient->patient_name }}" required>
        </div>

        <div class="form-group">
            <label for="gender">Gender</label>
            <select name="gender" class="form-control" required>
                <option value="M" {{ $patient->gender == 'M' ? 'selected' : '' }}>Male</option>
                <option value="F" {{ $patient->gender == 'F' ? 'selected' : '' }}>Female</option>
                <option value="Other" {{ $patient->gender == 'Other' ? 'selected' : '' }}>Other</option>
            </select>
        </div>

        <!-- Add other fields with pre-populated data -->

        <button type="submit" class="btn btn-primary">Update Patient</button>
    </form>
</div>

</body>
</html>
