<!DOCTYPE html>
<html lang="en">
<head>
     <!-- Import Bootstrap and Custom Styles -->
     <link href="{{ asset('theme.css') }}" rel="stylesheet">
     <link href="{{ asset('style.css') }}" rel="stylesheet">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
</head>
<!-- Personnel User Profile Page -->
<body>
    <!-- Include the header dynamically -->
    @include('admin_user.header_admin')

    <div class="main-content">
        <div class="profile-container mt-5">
            <div class="card">
                <div class="top-buttons d-flex flex-row align-self-center">
                    <a href="{{ route('admin.personnelUsers') }}" class="btn-back">&lt; Go Back</a>
                    <button class="btn-edit" data-bs-toggle="modal" data-bs-target="#editPersonnelModal">[Edit Information]</button>
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

    <!-- Modal for Editing Personnel Information -->
    <div class="modal fade" id="editPersonnelModal" tabindex="-1" aria-labelledby="editPersonnelModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPersonnelModalLabel">Edit Personnel Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.updatePersonnel', $personnel->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input type="text" name="first_name" id="first_name" value="{{ $personnel->first_name }}" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" name="last_name" id="last_name" value="{{ $personnel->last_name }}" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="phone_number">Phone Number</label>
                            <input type="text" name="phone_number" id="phone_number" value="{{ $personnel->phone_number }}" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" name="address" id="address" value="{{ $personnel->address }}" class="form-control">
                        </div>

                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

<!-- Existing Styling Preserved -->
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
