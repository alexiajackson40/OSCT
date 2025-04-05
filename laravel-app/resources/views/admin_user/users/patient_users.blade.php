<!DOCTYPE html>
<html lang="en">
<head>
     <!-- Import Bootstrap and Custom Styles -->
     <link href="{{ asset('theme.css') }}" rel="stylesheet">
     <link href="{{ asset('style.css') }}" rel="stylesheet">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
</head>
<!-- List of Patient Users Page -->
<body>
    <!-- Include the header dynamically -->
    @include('admin_user.header_admin')

    <div class="main-content d-flex align-self-center">
        <div class="profile-container mt-5">
            <div class="card">
                <div class="card-body d-flex flex-column align-self-center">
                    <h1 class="card-title">Patient Users</h1>
                    <div class="information-container d-flex flex-column align-items-left">
                        <h2 class="container-header">Patient List</h2>
                        <table id="Table" class="table">
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
                                        <td>{{ $patient->student_id }}</td>
                                        <td>
                                            <a class="btn btn-primary btn-sm" href="{{ route('admin.users.patient_profile', $patient->id) }}">View Profile</a>
                                            <a class="btn btn-success btn-sm" href="{{ route('admin.users.patient_measurements', $patient->id) }}">Measurements</a>
                                            <a class="btn btn-warning btn-sm" href="{{ route('admin.users.patient_documents', $patient->id) }}">Documents</a>
                                            <a class="btn btn-info btn-sm" href="{{ route('admin.users.patient_labResults', $patient->id) }}">Lab Results</a>
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
        height:auto;
        position:relative;
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
        width:100%;
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
        width:calc(100% - 1.75rem);
    }
</style>
</html>
