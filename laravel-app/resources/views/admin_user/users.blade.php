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
    <!-- Include the header -->
    @include('admin_user.header_admin')
    <div class="main-content">
        <!-- Side Buttons Container -->
        <div class="button-container mt-5 d-flex flex-column">
            <!-- Correct route names to match the defined routes -->
            <a class="table-btn" role="button" href="{{ route('admin.patientUsers') }}">Patients</a>
            <a class="table-btn" role="button" href="{{ route('admin.personnelUsers') }}">Personnel</a>
            <a class="table-btn" role="button" href="{{ route('admin.adminUsers') }}">Admin</a>
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
                <div class="card-head d-flex flex-row">
                    <h1 class="card-title">Users</h1>
                    <!-- Buttons for Add New Patient and CSV Upload -->
                    <div class="addBtn-container d-flex flex-row align-items-right mb-4">
                        <button id="toggleCSVForm" class="btn btn-success btn-import">Import via CSV</button>
                        <button id="toggleAddPatientForm" class="btn btn-primary btn-new">+ Add New User</button>
                    </div>
                </div>
                <!-- Add New Patient Form (Hidden by Default) -->
                <div id="addPatientForm" class="add-patient-form mb-4 p-4" style="display: none;">
                    <h2>Add New Patient</h2>
                    <form action="{{ route('admin.addPatient') }}" method="POST" class="form-inline">
                        @csrf
                        <div class="form-group mb-2">
                            <label for="first_name">PACIENTE:</label>
                            <input type="text" name="first_name" id="first_name" class="form-control mx-sm-2" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="gender">SEXO:</label>
                            <input type="text" name="gender" id="gender" class="form-control mx-sm-2">
                        </div>
                        <div class="form-group mb-2">
                            <label for="age">EDAD:</label>
                            <input type="number" name="age" id="age" class="form-control mx-sm-2">
                        </div>
                        <div class="form-group mb-2">
                            <label for="school_name">ESCUELA:</label>
                            <input type="text" name="school_name" id="school_name" class="form-control mx-sm-2">
                        </div>
                        <div class="form-group mb-2">
                            <label for="DERECHOHABIENCIA">DERECHOHABIENCIA:</label>
                            <input type="text" name="DERECHOHABIENCIA" id="DERECHOHABIENCIA" class="form-control mx-sm-2">
                        </div>
                        <div class="form-group mb-2">
                            <label for="fasting_status">AYUNO:</label>
                            <input type="text" name="fasting_status" id="fasting_status" class="form-control mx-sm-2">
                        </div>
                        <div class="form-group mb-2">
                            <label for="glucose">GLUCOSA:</label>
                            <input type="text" name="glucose" id="glucose" class="form-control mx-sm-2">
                        </div>
                        <div class="form-group mb-2">
                            <label for="triglycerides">TRIGLICÉRIDOS:</label>
                            <input type="text" name="triglycerides" id="triglycerides" class="form-control mx-sm-2">
                        </div>
                        <div class="form-group mb-2">
                            <label for="total_cholesterol">COLESTEROL TOTAL:</label>
                            <input type="text" name="total_cholesterol" id="total_cholesterol" class="form-control mx-sm-2">
                        </div>
                        <div class="form-group mb-2">
                            <label for="hba1c">HBA1C:</label>
                            <input type="text" name="hba1c" id="hba1c" class="form-control mx-sm-2">
                        </div>
                        <div class="form-group mb-2">
                            <label for="weight">PESO:</label>
                            <input type="text" name="weight" id="weight" class="form-control mx-sm-2">
                        </div>
                        <div class="form-group mb-2">
                            <label for="height">TALLA:</label>
                            <input type="text" name="height" id="height" class="form-control mx-sm-2">
                        </div>
                        <div class="form-group mb-2">
                            <label for="bmi">IMC:</label>
                            <input type="text" name="bmi" id="bmi" class="form-control mx-sm-2">
                        </div>
                        <div class="form-group mb-2">
                            <label for="waist">CINTURA:</label>
                            <input type="text" name="waist" id="waist" class="form-control mx-sm-2">
                        </div>
                        <div class="form-group mb-2">
                            <label for="hip">CADERA:</label>
                            <input type="text" name="hip" id="hip" class="form-control mx-sm-2">
                        </div>
                        <div class="form-group mb-2">
                            <label for="icc">ICC:</label>
                            <input type="text" name="icc" id="icc" class="form-control mx-sm-2">
                        </div>
                        <div class="form-group mb-2">
                            <label for="comments">COMENTARIO:</label>
                            <textarea name="comments" id="comments" class="form-control mx-sm-2"></textarea>
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
                <div class="card-body d-flex flex-column">
                    <div class="document-content">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ ucfirst($user->role) }}</td>
                                        <td>
                                            <!-- Change this to View -->
                                            <a href="{{ route('admin.users.edit', $user->getKey()) }}" class="btn btn-view btn-warning">Change to View</a>
                                            <!-- Remove Button -->
                                            <form action="{{ route('admin.users.destroy', $user->getKey()) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
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
    <script src="{{ asset('js/loadContent.js') }}"></script>
    <script type="module" src="{{ asset('js/main.js') }}"></script>
<style>
    /* Styling for Containers*/
    .main-content {
        display: flex;
        justify-content: left;
        width: 100%;
        min-height: 100vh;
        background-color: var(--light-surface-one);
    }
    .users-container {
        width: 70%;
    }
    .card {
        background-color: #FAFAFA;
        height: 100%;
        min-height: 100vh;
        display: flex;
        justify-content: center;
    }
    .document-content {
        margin-left: 1.5625rem;
        margin-right: 1.5625rem;
    }
    .card-head{
        width: 93%;
        display: flex;
        justify-content: space-between;
        align-self: center;
        margin-top: 0.5rem;
    }
    /*-----------------------------------*/
    /* Styling for Users List Buttons*/
    .button-container {
        width: 13.375rem;
        height: fit-content;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-right: 0.5rem;
        margin-left: 0.5rem;
        gap: 0.5rem;
    }
    .table-btn {
        width: 100%;
        height: 3.75rem;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 0.5rem;
        background: #7C1332;
        box-shadow: 0rem 0.25rem 0.25rem 0rem rgba(0, 0, 0, 0.25);
        color: #FFF;
        font-size: 1.25rem;
        font-weight: 500;
        text-decoration: none;
    }
    .table-btn:hover {
        background-color: #52051C;
    }
    .active-btn {
        background: #808080;
        box-shadow: 0rem 0.25rem 0.25rem 0rem rgba(0, 0, 0, 0.25) inset;
    }
    /*-----------------------------------*/
    /* Styling Title*/
    .card-title {
        font-size: 2.2rem;
        font-weight: 500;
        text-align: left;
        margin-bottom: 1.5625rem;
        margin-top: 2rem;
    }
    /*-----------------------------------*/
    /* Styling for Add and Import Buttons*/
    .addBtn-container{
        margin-left: 1rem;
        margin-top: 1rem;
    }
    .btn-new {
        width: fit-content;
        height: 3rem;
        display: flex;
        align-items: center;
        border-radius: 0.5rem;
        font-weight: 500;
    }
    .btn-import {
        width: fit-content;
        height: 3rem;
        display: flex;
        align-items: center;
        border-radius: 0.5rem;
        font-weight: 500;
    }
    /*-----------------------------------*/
    /* Styling for Table*/
    .table {
        align-items: center;
        margin-bottom: 0rem;
        --bs-table-bg: white;
        --bs-table-border-color: #000;
        border: 0.063rem solid #000000;
    }
    /*-----------------------------------*/
    /* Styling for View and Delete Buttons*/
    .btn-danger {
        height: 3rem;
        display: flex;
        align-items: center;
        border-radius: 0.5rem;
        font-weight: 500;
        justify-content: center;
    }
    .btn-view {
        height: 3rem;
        display: flex;
        align-items: center;
        border-radius: 0.5rem;
        font-weight: 500;
        justify-content: center;
    }
    /*-----------------------------------*/
</style>
</body>
</html>
