<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patients - Operación Salud Colima Tamizaje</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

    <div class="container">
        <h1>Patients</h1>

        <!-- Search bar -->
        <form method="GET" action="{{ url('/patients') }}">
            <input type="text" name="search" value="{{ $search }}" placeholder="Search by Name">
            <button type="submit">Search</button>
        </form>

        <!-- Button to add new patient -->
        <a href="{{ route('patients.create') }}" class="btn btn-primary">Add New Patient</a>

        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>No. SOL</th>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Age</th>
                    <th>School</th>
                    <th>Glucose</th>
                    <th>Triglycerides</th>
                    <th>Cholesterol</th>
                    <th>HbA1c</th>
                    <th>Weight</th>
                    <th>Height</th>
                    <th>BMI</th>
                    <th>ICC</th>
                    <th>Waist</th>
                    <th>Hip</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($patients as $patient)
                    <tr>
                        <td>{{ $patient->no_sol }}</td>
                        <td>{{ $patient->patient_name }}</td>
                        <td>{{ $patient->gender }}</td>
                        <td>{{ $patient->age }}</td>
                        <td>{{ $patient->school }}</td>
                        <td>{{ $patient->glucose }}</td>
                        <td>{{ $patient->triglycerides }}</td>
                        <td>{{ $patient->cholesterol_total }}</td>
                        <td>{{ $patient->hba1c }}</td>
                        <td>{{ $patient->weight }}</td>
                        <td>{{ $patient->height }}</td>
                        <td>{{ $patient->bmi }}</td>
                        <td>{{ $patient->icc }}</td>
                        <td>{{ $patient->waist }}</td>
                        <td>{{ $patient->hip }}</td>
                        <td>
                            <!-- Edit button -->
                            <a href="{{ route('patients.edit', $patient->id) }}" class="btn btn-warning">Edit</a>
                            <!-- Delete button -->
                            <form action="{{ route('patients.destroy', $patient->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
        {{ $patients->links() }}
    </div>

</body>
</html>
