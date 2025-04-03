<!DOCTYPE html>
<html lang="en">
<!-- Personnel User Profile Page-->
<body>
    <div id="header"></div> 
    <div class="main-content">
        <div class="profile-container mt-5">
            <div class="card">
                <div class="top-buttons d-flex flex-row align-self-center">
                    <a href="{{ route('admin.users.personnel_users') }}" class="btn-back">&lt; Go Back</a>
                    <button class="btn-edit">[Edit Information]</button>
                </div>
                <div class="card-body d-flex flex-column align-self-center">
                    <h1 class="card-title">{{ $personnel->first_name }} {{ $personnel->last_name }}</h1>
                    <div class="information-container d-flex flex-column align-items-left">
                        <h2 class="container-header">Personnel Information</h2>
                        <table id="Table" class="table">
                            <tr>
                                <td><strong>Employee ID:</strong></td>
                                <td>{{ $personnel->employee_id }}</td>
                            </tr>
                            <tr>
                                <td><strong>Phone Number:</strong></td>
                                <td>{{ $personnel->phone_number }}</td>
                            </tr>
                            <tr>
                                <td><strong>Username:</strong></td>
                                <td>{{ $personnel->username }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="contact-container d-flex flex-column align-items-left">
                        <h2 class="container-header">Contact Information</h2>
                        <table id="Table" class="table">
                            <tr>
                                <td><strong>Email:</strong></td>
                                <td>{{ $personnel->email }}</td>
                            </tr>
                            <tr>
                                <td><strong>Address:</strong></td>
                                <td>{{ $personnel->address ?? 'Not provided' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="button-container mt-5 d-flex flex-column">      
        <a class="record-btn btn-primary" role="button" href="{{ route('admin.users.personnel_profile', $personnel->id) }}">Personnel Profile</a>
        <a class="record-btn btn-primary" role="button" href="{{ route('admin.users.patient_measurements', $personnel->id) }}">Measurements</a>
        <a class="record-btn btn-primary" role="button" href="{{ route('admin.users.patient_documents', $personnel->id) }}">Documents</a>
        <a class="record-btn btn-primary" role="button" href="{{ route('admin.users.patient_labResults', $personnel->id) }}">Lab Results</a>
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
        width:545px;
        height:700px;
        position:relative;
    }
    .top-buttons {
        margin-top:10px;
        margin-bottom:10px;
        width:449px;
        padding-top:10px;
        display:flex;
        flex-direction:row;
    }
    .card-body {
        padding-top:10px;
        display:flex;
        flex-direction:column;
    }
    .card-title {
        font-size:32px;
        font-weight:500;
        margin-top:40px;
    }
    .container-header {
        font-size:20px;
        font-weight:500;
        padding-left:14px;
        padding-top:14px;
    }
    .information-container {
        margin-top:12px;
        width:449px;
        height:auto;
        border-radius:6px;
        border:1px solid rgba(0, 0, 0, 0.30);
        background:#FFF;
    }
    .contact-container {
        margin-top:15px;
        width:449px;
        height:auto;
        border-radius:6px;
        border:1px solid rgba(0, 0, 0, 0.30);
        background:#FFF;
    }
    .table {
        margin-left:14px;
        color:#000000;
        font-size:16px;
        font-weight:400;
        width:auto;
    }
    .btn-back {
        position:absolute;
        left:30px;
        font-size:20px;
        font-weight:500;
        border:none;
        color:#000;
        background:#F2F2F2;
    }
    .btn-edit {
        position:absolute;
        right:30px;
        border:none;
        color:#000;
        background:#F2F2F2;
        font-size:20px;
        font-weight:500;
    }
</style>
</html>
