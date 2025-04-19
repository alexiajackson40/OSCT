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
        <div class="profile-container mt-5">
            <div class="card">
                <!-- Top Buttons -->
                <div class="top-buttons d-flex flex-row align-self-center">
                    <a href="{{ route('admin.patientUsers') }}" class="btn-back">&lt; Go Back</a>
                    {{-- Use the admin guard check instead of a call to isAdmin() --}}
                    @if(auth()->guard('admin')->check())
                        <button class="btn-edit" data-bs-toggle="modal" data-bs-target="#editPatientModal">[Edit Information]</button>
                    @endif
                </div>
                <!-- Patient Information -->
                <div class="card-body d-flex flex-column">
                    <!-- Instead of separate first and last names, display the full patient name from the PACIENTE column -->
                    <h1 class="card-title">{{ $patient->PACIENTE }}</h1>
                    <div class="information-container d-flex flex-column align-items-left">
                        <h2 class="container-header">Patient Information</h2>
                        <table class="table">
                            <tr>
                                <td><strong>Student ID:</strong></td>
                                <td>{{ $patient->No_SOL }}</td>
                            </tr>
                            <tr>
                                <td><strong>Gender:</strong></td>
                                <td>{{ $patient->SEXO }}</td>
                            </tr>
                            <tr>
                                <td><strong>Age:</strong></td>
                                <td>{{ $patient->EDAD }}</td>
                            </tr>
                            <tr>
                                <td><strong>School:</strong></td>
                                <td>{{ $patient->ESCUELA }}</td>
                            </tr>
                            <tr>
                                <td><strong>CURP:</strong></td>
                                <td>{{ $patient->CURP }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Navigation Buttons -->
        <div class="button-container mt-5 d-flex flex-column">      
            <a class="record-btn btn-primary active-btn" role="button" href="{{ route('admin.users.patient_profile', $patient->CURP) }}">Patient Profile</a>
            <a class="record-btn btn-primary" role="button" href="{{ route('admin.users.patient_measurements', $patient->CURP) }}">Measurements</a>
            <a class="record-btn btn-primary" role="button" href="{{ route('admin.users.patient_documents', $patient->CURP) }}">Documents</a>
            <a class="record-btn btn-primary" role="button" href="{{ route('admin.users.patient_labResults', $patient->CURP) }}">Lab Results</a>
        </div>
    </div>
    <!-- Modal for Editing Patient Information -->
    <div class="modal fade" id="editPatientModal" tabindex="-1" aria-labelledby="editPatientModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPatientModalLabel">Edit Patient Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.updatePatient', $patient->CURP) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="first_name">Full Name</label>
                            <input type="text" name="first_name" id="first_name" value="{{ $patient->PACIENTE }}" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="school_name">School</label>
                            <input type="text" name="school_name" id="school_name" value="{{ $patient->ESCUELA }}" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <input type="text" name="gender" id="gender" value="{{ $patient->SEXO }}" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="age">Age</label>
                            <input type="number" name="age" id="age" value="{{ $patient->EDAD }}" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="fasting_status">Fasting Status</label>
                            <input type="text" name="fasting_status" id="fasting_status" value="{{ $patient->AYUNO }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="glucose">Glucose</label>
                            <input type="text" name="glucose" id="glucose" value="{{ $patient->GLUCOSA }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="triglycerides">Triglycerides</label>
                            <input type="text" name="triglycerides" id="triglycerides" value="{{ $patient->TRIGLICÉRIDOS }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="total_cholesterol">Total Cholesterol</label>
                            <input type="text" name="total_cholesterol" id="total_cholesterol" value="{{ $patient->{'COLESTEROL TOTAL'} }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="hba1c">HBA1C</label>
                            <input type="text" name="hba1c" id="hba1c" value="{{ $patient->HBA1C }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="weight">Weight</label>
                            <input type="text" name="weight" id="weight" value="{{ $patient->PESO }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="height">Height</label>
                            <input type="text" name="height" id="height" value="{{ $patient->TALLA }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="bmi">BMI</label>
                            <input type="text" name="bmi" id="bmi" value="{{ $patient->IMC }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="icc">ICC</label>
                            <input type="text" name="icc" id="icc" value="{{ $patient->ICC }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="waist">Waist</label>
                            <input type="text" name="waist" id="waist" value="{{ $patient->CINTURA }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="hip">Hip</label>
                            <input type="text" name="hip" id="hip" value="{{ $patient->CADERA }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="comments">Comment</label>
                            <textarea name="comments" id="comments" class="form-control">{{ $patient->COMENTARIO }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<style>
    /* Styling for Containers*/
    .main-content {
        display: flex;
        justify-content: center;
        width: 100%;
        min-height: 100vh;
        background-color: var(--light-surface-one);
    }
    .profile-container {
        width: fit-content;
    }
    .card {
        background-color: #FAFAFA;
        width: fit-content;
        height: fit-content;
        display: flex;
        justify-content: center;
    }
    .card-body {
        margin-bottom: 1rem;
        margin-left: 0.625rem;
        margin-right: 0.625rem;
        padding-top: 0.625rem;
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    /*-----------------------------------*/
    /* Styling for Back and Edit Buttons*/
    .top-buttons {
        margin-top: 0.625rem;
        margin-bottom: 0.625rem;
        width: 28.063rem;
        padding-top: 0.625rem;
        display: flex;
        flex-direction: row;
    }
    .btn-back {
        position: absolute;
        left: 1.875rem;
        font-size: 1.25rem;
        font-weight: 500;
        border: none;
        color: #000;
        background: #FAFAFA;
        border-radius: 1rem;
        text-decoration: none;
    }
    .btn-back:hover {
        background-color: #E0E0E0;
    }
    .btn-edit {
        position: absolute;
        right: 1.875rem;
        border: none;
        color: #000;
        background: #FAFAFA;
        font-size: 1.25rem;
        font-weight: 500;
        border-radius: 1rem;
    }
    .btn-edit:hover {
        background-color: #E0E0E0;
    }
    /*-----------------------------------*/
    /* Styling Title*/
    .card-title {
        font-size: 2rem;
        font-weight: 500;
        margin-top: 2.5rem;
        width: 28.063rem;
    }
    /*-----------------------------------*/
    /* Styling for Table*/
    .container-header {
        font-size: 1.25rem;
        font-weight: 500;
        padding-left: 0.875rem;
        padding-top: 0.875rem;
    }
    .information-container {
        margin-top: 0.75rem;
        width: 28.063rem;
        height: auto;
        border-radius: 0.375rem;
        border: 0.063rem solid rgba(0,0,0,0.30);
        background: #FFF;
    }
    /*Contact Container needs to go here */
    .table {
        margin-left: 0.875rem;
        color: #000;
        font-size: 1rem;
        font-weight: 400;
        width: auto;
    }
    /*-----------------------------------*/
    /* Styling for Side Buttons*/
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
    .record-btn {
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
    .record-btn:hover {
        background-color: #52051C;
        }
    .active-btn {
        background: #808080;
        box-shadow: 0rem 0.25rem 0.25rem 0rem rgba(0, 0, 0, 0.25) inset;
    }
    /*-----------------------------------*/
</style>
</html>
