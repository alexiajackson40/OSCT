<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Import Bootstrap and Custom Styles -->
    <link href="{{ asset('theme.css') }}" rel="stylesheet">
    <link href="{{ asset('style.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
</head>
<body>
    <!-- Include the header dynamically -->
    @include('admin_user.header_admin')

    <div class="main-content">
        <!-- Side Buttons Container -->
        <div class="button-container mt-5 d-flex flex-column">
            @if(auth()->user()->isAdmin())  <!-- Check if the logged-in user is an admin -->
                <a class="table-btn btn-primary" role="button" href="{{ route('admin.patientUsers') }}">Patients</a>
                <a class="table-btn btn-primary" role="button" href="{{ route('admin.personnelUsers') }}">Personnel</a>
                <a class="table-btn btn-primary" role="button" href="{{ route('admin.adminUsers') }}">Admin</a>
            @endif
        </div>

        <!-- Users Container -->
        <div class="users-container mt-5">
            <div class="card">
                <!-- Show success/error messages -->
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                
                <!-- Buttons for Add New Patient and CSV Upload -->
                @if(auth()->user()->isAdmin())  <!-- Show the Add and Upload buttons only for admins -->
                    <div class="d-flex align-items-center mb-4">
                        <button id="toggleAddPatientForm" class="btn btn-primary me-3">Add New Patient</button>
                        <button id="toggleCSVForm" class="btn btn-success">Import Patients via CSV</button>
                    </div>

                    <!-- Add New Patient Form (Hidden by Default) -->
                    <div id="addPatientForm" class="add-patient-form mb-4 p-4" style="display: none;">
                        <h2>Add New Patient</h2>
                        <form action="{{ route('admin.addPatient') }}" method="POST" class="form-inline">
                            @csrf
                            <div class="form-group mb-2">
                                <label for="first_name">First Name:</label>
                                <input type="text" name="first_name" id="first_name" class="form-control mx-sm-2" required>
                            </div>
                            <div class="form-group mb-2">
                                <label for="last_name">Last Name:</label>
                                <input type="text" name="last_name" id="last_name" class="form-control mx-sm-2" required>
                            </div>
                            <div class="form-group mb-2">
                                <label for="username">Username:</label>
                                <input type="text" name="username" id="username" class="form-control mx-sm-2" required>
                            </div>
                            <div class="form-group mb-2">
                                <label for="password">Password:</label>
                                <input type="password" name="password" id="password" class="form-control mx-sm-2" required>
                            </div>
                            <div class="form-group mb-2">
                                <label for="email">Email:</label>
                                <input type="email" name="email" id="email" class="form-control mx-sm-2">
                            </div>
                            <div class="form-group mb-2">
                                <label for="phone">Phone:</label>
                                <input type="text" name="phone" id="phone" class="form-control mx-sm-2">
                            </div>
                            <button type="submit" class="btn btn-primary mb-2">Add Patient</button>
                        </form>
                    </div>

                    <!-- CSV Upload Form (Hidden by Default) -->
                    <div id="uploadCSVForm" class="upload-csv-form mb-4" style="display: none;">
                        <h2>Import Patients via CSV</h2>
                        <form action="{{ route('admin.importPatients') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-2">
                                <label for="csv_file">Choose CSV File:</label>
                                <input type="file" name="csv_file" id="csv_file" class="form-control" accept=".csv" required>
                            </div>
                            <button type="submit" class="btn btn-success mb-2">Upload and Import</button>
                        </form>
                    </div>
                @endif

                <!-- Card Body -->
                <div class="card-body d-flex flex-column">
                    <div class="document-content">
                        <h1 class="card-title">Patient Users</h1>
                        <!-- Table List -->
                        <table id="Table" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Student ID</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($patients as $patient)
                                    <tr>
                                        <td>{{ $patient->first_name }}</td>
                                        <td>{{ $patient->last_name }}</td>
                                        <td>{{ $patient->id }}</td>
                                        <td>
                                            <!-- View Profile Button -->
                                            <a href="{{ route('admin.users.patient_profile', $patient->id) }}" class="btn btn-primary btn-sm">View Profile</a>
                                            <!-- Remove Button -->
                                            <form action="{{ route('admin.removePatient', $patient->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Toggle Add Patient Form
        document.getElementById('toggleAddPatientForm').addEventListener('click', function () {
            const form = document.getElementById('addPatientForm');
            const isHidden = form.style.display === 'none';
            form.style.display = isHidden ? 'block' : 'none';
        });

        // Toggle CSV Upload Form
        document.getElementById('toggleCSVForm').addEventListener('click', function () {
            const form = document.getElementById('uploadCSVForm');
            const isHidden = form.style.display === 'none';
            form.style.display = isHidden ? 'block' : 'none';
        });
    </script>
</body>

<style>
    .main-content {
        display: flex;
        justify-content: left;
        width: 100%;
        min-height: 100vh;
    }
    .users-container {
        width: 70%;
    }
    .card {
        background-color: #F2F2F2;
        height: 100%;
        min-height: 100vh;
    }
    .document-content {
        margin-left: 1.5625rem;
        margin-right: 1.5625rem;
    }
    .card-title {
        font-size: 2rem;
        font-weight: 500;
        text-align: left;
        margin-bottom: 1.5625rem;
        margin-top: 1.5625rem;
    }
    .button-container {
        width: 13.375rem;
        height: 13rem;
        display: flex;
        justify-content: center;
        justify-content: space-around;
        align-items: center;
        margin-right: 0.5rem;
        margin-left: 0.5rem;
    }
    .table-btn {
        width: 214px;
        height: 60px;
        display: inline-flex;
        padding: 18.5px 40px 18.5px 39px;
        justify-content: center;
        align-items: center;
        border-radius: 8px;
        background: #6F1A34;
        box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);
        color: #FFF;
        font-size: 20px;
        font-weight: 500;
    }
    .table {
        align-items: center;
        margin-bottom: 0px;
        --bs-table-bg: #F2F2F2;
        --bs-table-border-color: #000;
    }
    .btn-page {
        position: absolute;
        right: 4px;
        width: 214px;
        height: 60px;
        border: none;
        color: #000;
        background: #F2F2F2;
        font-size: 20px;
        font-weight: 500;
    }
</style>
</html>
