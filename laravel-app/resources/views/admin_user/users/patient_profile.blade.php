<!DOCTYPE html>
<html lang="en">
<head>
     <!-- Import Bootstrap and Custom Styles -->
     <link href="{{ asset('theme.css') }}" rel="stylesheet">
     <link href="{{ asset('style.css') }}" rel="stylesheet">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
</head>
<!-- Patient User Profile Page -->
<body>
    <!-- Include the header dynamically -->
    @include('admin_user.header_admin') 

    <div class="main-content d-flex align-self-center">
        <div class="profile-container mt-5">
            <div class="card">
                <!-- Top Buttons -->
                <div class="top-buttons d-flex flex-row align-self-center">
                    <a href="{{ route('admin.patientUsers') }}" class="btn-back">&lt; Go Back</a>
                    <button class="btn-edit" data-bs-toggle="modal" data-bs-target="#editPatientModal">[Edit Information]</button>
                </div>

                <!-- Patient Information -->
                <div class="card-body d-flex flex-column align-self-center">
                    <h1 class="card-title">{{ $patient->first_name }} {{ $patient->last_name }}</h1>
                    <div class="information-container d-flex flex-column align-items-left">
                        <h2 class="container-header">Patient Information</h2>
                        <table id="Table" class="table">
                            <tr>
                                <td><strong>Student ID:</strong></td>
                                <td>{{ $patient->student_id }}</td>
                            </tr>
                            <tr>
                                <td><strong>Phone Number:</strong></td>
                                <td>{{ $patient->phone_number }}</td>
                            </tr>
                            <tr>
                                <td><strong>Username:</strong></td>
                                <td>{{ $patient->username }}</td>
                            </tr>
                        </table>
                    </div>
                    
                    <!-- Contact Information -->
                    <div class="contact-container d-flex flex-column align-items-left">
                        <h2 class="container-header">Contact Information</h2>
                        <table id="Table" class="table">
                            <tr>
                                <td><strong>Email:</strong></td>
                                <td>{{ $patient->email }}</td>
                            </tr>
                            <tr>
                                <td><strong>Address:</strong></td>
                                <td>{{ $patient->address ?? 'Not provided' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Navigation Buttons -->
            <div class="button-container mt-5 d-flex flex-column">      
                <a class="record-btn btn-primary" role="button" href="{{ route('admin.users.patient_profile', $patient->id) }}">Patient Profile</a>
                <a class="record-btn btn-primary" role="button" href="{{ route('admin.users.patient_measurements', $patient->id) }}">Measurements</a>
                <a class="record-btn btn-primary" role="button" href="{{ route('admin.users.patient_documents', $patient->id) }}">Documents</a>
                <a class="record-btn btn-primary" role="button" href="{{ route('admin.users.patient_labResults', $patient->id) }}">Lab Results</a>
            </div>
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
                    <form action="{{ route('admin.updatePatient', $patient->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input type="text" name="first_name" id="first_name" value="{{ $patient->first_name }}" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" name="last_name" id="last_name" value="{{ $patient->last_name }}" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="phone_number">Phone Number</label>
                            <input type="text" name="phone_number" id="phone_number" value="{{ $patient->phone_number }}" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" name="address" id="address" value="{{ $patient->address }}" class="form-control">
                        </div>

                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

<!-- Existing Styling Maintained -->
<style>
    .main-content {
        display:flex;
        justify-content:center;
        width:100%;
        min-height:100vh;
    }
    .profile-container {
        width:70%;
        display:flex;
        justify-content:center;
    }
    .card {
        background-color:#F2F2F2;
        width:34.063rem;
        height:800px;
        position:relative;
    }
    .top-buttons {
        margin-top:0.625rem;
        margin-bottom:0.625rem;
        width:28.063;
        padding-top:0.625rem;
        display:flex;
        flex-direction:row;
    }
    .card-body {
        padding-top:0.625rem;
        display:flex;
        flex-direction:column;
    }
    .card-title {
        font-size:2rem;
        font-weight:500;
        margin-top:2.5rem;
    }
    .container-header {
        font-size:1.25rem;
        font-weight:500;
        padding-left:0.875rem;
        padding-top:0.875rem;
    }
    .information-container {
        margin-top:0.75rem;
        width:28.063rem;
        height:auto;
        border-radius:0.375rem;
        border:0.063rem solid rgba(0, 0, 0, 0.30);
        background:#FFF;
    }
    .contact-container {
        margin-top:0.938rem;
        width:28.063rem;
        height:auto;
        border-radius:0.375rem;
        border:0.063rem solid rgba(0, 0, 0, 0.30);
        background:#FFF;
    }
    .table {
        margin-left:0.875rem;
        color:#000000;
        font-size:1rem;
        font-weight:400;
        width:auto;
    }
    .btn-back {
        position:absolute;
        left:1.875rem;
        font-size:1.25rem;
        font-weight:500;
        border:none;
        color:#000;
        background:#F2F2F2;
    }
    .btn-edit {
        position:absolute;
        right:1.875rem;
        border:none;
        color:#000;
        background:#F2F2F2;
        font-size:1.25rem;
        font-weight:500;
    }
    .button-container {
        width:13.375rem;
        height:17rem;
        display:flex;
        flex-direction: column;
        justify-content:space-between;
        margin-right:0.5rem;
        margin-left:0.5rem;
    }
    .record-btn {
        width:214px;
        height:60px;
        display:inline-flex;
        padding:18.5px 40px 18.5px 39px;
        justify-content:center;
        align-items:center;
        border-radius:8px;
        background:#6F1A34;
        box-shadow:0px 4px 4px 0px rgba(0, 0, 0, 0.25);
        color:#FFF;
        font-size:20px;
        font-weight:500;
    }
</style>
</html>
