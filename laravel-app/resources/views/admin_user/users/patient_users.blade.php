<!DOCTYPE html>
<html lang="en">
<!-- Patient User Profile Page-->
<body>
    <div id="header"></div> 
    <div class="main-content d-flex align-self-center">
        <div class="profile-container mt-5">
            <div class="card">
                <div class="top-buttons d-flex flex-row align-self-center">
                    <a href="{{ route('admin.users.patient_users') }}" class="btn-back">&lt; Go Back</a>
                    <button class="btn-edit">[Edit Information]</button>
                </div>
                <div class="card-body d-flex flex-column align-self-center"> <!--Makes card customizable-->
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
            <div class="button-container mt-5 d-flex flex-column">      
                <a class="record-btn btn-primary" role="button" href="{{ route('admin.users.patient_profile', $patient->id) }}">Patient Profile</a>
                <a class="record-btn btn-primary" role="button" href="{{ route('admin.users.patient_measurements', $patient->id) }}">Measurements</a>
                <a class="record-btn btn-primary" role="button" href="{{ route('admin.users.patient_documents', $patient->id) }}">Documents</a>
                <a class="record-btn btn-primary" role="button" href="{{ route('admin.users.patient_labResults', $patient->id) }}">Lab Results</a>
            </div>
        </div>
    </div>
</body>

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
