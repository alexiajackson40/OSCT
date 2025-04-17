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
    @include('layouts.header_patient') <!-- Include the header blade -->

    <div class="main-content">
        <div class="profile-container mt-5">
            <div class="card">
                <div class="card-body d-flex flex-column align-self-center">
                    <h1 class="card-title">{{ $patient->first_name }} {{ $patient->last_name }}</h1>
                    <div class="information-container d-flex flex-column align-items-left">
                        <h2 class="container-header">Patient Information</h2>
                        <table id="Table" class="table">
                            <tr>
                                <th>Student ID</th>
                                <td>{{ $parent->student_id ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Student Name</th>
                                <td>{{ $patient->PACIENTE ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Phone Number</th>
                                <td>{{ $parent->phone_number ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Username</th>
                                <td>{{ $parent->username ?? 'N/A' }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="contact-container d-flex flex-column align-items-left">
                        <h2 class="container-header">Contact Information</h2>
                        <table id="Table" class="table">
                            <tr>
                                <th>Email</th>
                                <td>{{ $patient->email }}</td>
                            </tr>
                            <tr>
                                <th>Address</th>
                                <td>{{ $patient->address ?? 'N/A' }}</td>
                            </tr>
                        </table>
                    </div>
                    <button class="btn-page btn-primary">Measurements</button>
                </div>
            </div>
        </div>
    </div>

</body>

<style>
    .main-content {
        display: flex;
        justify-content: center;
        width: 100%;
        min-height: 100vh;
    }
    .profile-container {
        width: 70%;
        display: flex;
        justify-content: center;
    }
    .card {
        background-color: #F2F2F2;
        width: 545px;
        height: auto;
    }
    .card-body {
        padding-top: 35px;
    }
    .card-title {
        font-size: 32px;
        font-weight: 500;
    }
    .container-header {
        font-size: 20px;
        font-weight: 500;
        padding-left: 14px;
        padding-top: 14px;
    }
    .information-container {
        margin-top: 12px;
        width: 449px;
        height: auto;
        border-radius: 6px;
        border: 1px solid rgba(0, 0, 0, 0.30);
        background: #FFF;
    }
    .contact-container {
        margin-top: 15px;
        width: 449px;
        height: auto;
        border-radius: 6px;
        border: 1px solid rgba(0, 0, 0, 0.30);
        background: #FFF;
    }
    .table {
        margin-left: 14px;
        color: #000000;
        font-size: 16px;
        font-weight: 400;
        width: auto;
    }
    .btn-page {
        margin-top: 30px;
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
        align-self: center;
    }
</style>
</html>
