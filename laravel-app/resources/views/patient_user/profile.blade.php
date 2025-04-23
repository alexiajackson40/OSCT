<!DOCTYPE html>
<html lang="en">
<!-- Patient User Profile Page -->
<head>
     <!-- Import Bootstrap and Custom Styles -->
     <link href="{{ asset('theme.css') }}" rel="stylesheet">
     <link href="{{ asset('style.css') }}" rel="stylesheet">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
</head>
<body>
    @include('layouts.header_patient')
    <div class="main-content">
        <div class="profile-container mt-5">
            <div class="card">
                <div class="card-body d-flex flex-column">
                    <h1 class="card-title">{{ $patient->PACIENTE }} </h1>
                    <div class="information-container d-flex flex-column align-items-left">
                        <h2 class="container-header">Patient Information</h2>
                        <table class="table">
                            <tr>
                                <th>Student ID</th>
                                <td>{{ $patient->CURP ?? 'N/A' }}</td>
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
                        <table class="table">
                            <tr>
                                <th>Email</th>
                                <td>{{ $parent->email }}</td>
                            </tr>
                            <tr>
                                <th>Address</th>
                                <td>{{ $parent->address ?? 'N/A' }}</td>
                            </tr>
                        </table>
                    </div>
                    <a href="{{ route('patient.measurements') }}" class="btn-page btn-primary">Measurements</a>
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
        padding: 2.5rem;
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    /*-----------------------------------*/
    /* Styling Title*/
    .card-title {
        font-size: 2rem;
        font-weight: 500;
        margin-top: 2.5rem;
        width: 28rem;
    }
    /*-----------------------------------*/
    /* Styling for Table*/
    .container-header {
        font-size: 1.25rem;
        font-weight: 500;
        padding: 0.9rem 0rem 0rem 0.9rem;
    }
    .information-container {
        margin-top: 0.75rem;
        width: 28rem;
        height: auto;
        border-radius: 0.375rem;
        border: 0.063rem solid rgba(0,0,0,0.30);
        background: #FFF;
    }
    .contact-container {
        margin-top: 1rem;
        width: 28rem;
        height: auto;
        border-radius: 0.375rem;
        border: 0.063rem solid rgba(0,0,0,0.30);
        background: #FFF;
    }
    .table {
        margin-left: 0.9rem;
        color: #000;
        font-size: 1rem;
        font-weight: 400;
        width: auto;
    }
    /*-----------------------------------*/
    /* Styling for Measurements Button*/
    .btn-page {
        margin-top: 1.8rem;
        width: 13rem;
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
        align-self: center;
    }
    .btn-page:hover {
        background-color: #52051C;
    }
    /*-----------------------------------*/
</style>
</html>
