<!DOCTYPE html>
<html lang="en">
<head>
     <!-- Import Bootstrap and Custom Styles -->
     <link href="{{ asset('theme.css') }}" rel="stylesheet">
     <link href="{{ asset('style.css') }}" rel="stylesheet">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
</head>
<!-- Admin User Profile Page -->
<body>
    <!-- Include the header dynamically -->
    @include('admin_user.header_admin')

    <div class="main-content">
        <div class="profile-container mt-5">
            <div class="card">
                <div class="top-buttons d-flex flex-row align-self-center">
                    <!-- Back Button -->
                    <a id="back-btn" class="btn-back" href="{{ route('admin.adminUsers') }}">&lt; Go Back</a>
                    <button class="btn-edit" data-bs-toggle="modal" data-bs-target="#editAdminModal">[Edit Information]</button>
                </div>
                <div class="card-body d-flex flex-column align-self-center">
                    <!-- Admin Info -->
                    <h1 class="card-title">{{ $admin->first_name }} {{ $admin->last_name }}</h1>
                    <div class="information-container d-flex flex-column align-items-left">
                        <h2 class="container-header">User Information</h2>
                        <table id="Table" class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>{{ $admin->first_name }} {{ $admin->last_name }}</th>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <th>{{ $admin->email }}</th>
                                </tr>
                            </thead>
                        </table>
                    </div>

                    <!-- Contact Info -->
                    <div class="contact-container d-flex flex-column align-items-left">
                        <h2 class="container-header">Contact Information</h2>
                        <table id="Table" class="table">
                            <thead>
                                <tr>
                                    <th>Phone</th>
                                    <th>{{ $admin->phone ?? 'N/A' }}</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Editing Admin Information -->
    <div class="modal fade" id="editAdminModal" tabindex="-1" aria-labelledby="editAdminModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editAdminModalLabel">Edit Admin Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.updateAdmin', $admin->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input type="text" name="first_name" id="first_name" value="{{ $admin->first_name }}" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" name="last_name" id="last_name" value="{{ $admin->last_name }}" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" value="{{ $admin->email }}" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" name="phone" id="phone" value="{{ $admin->phone }}" class="form-control">
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
        height: 700px;
        position: relative;
    }
    .top-buttons {
        margin-top: 10px;
        margin-bottom: 10px;
        width: 449px;
        padding-top: 10px;
        display: flex;
        flex-direction: row;
    }
    .card-body {
        padding-top: 10px;
        display: flex;
        flex-direction: column;
    }
    .card-title {
        font-size: 32px;
        font-weight: 500;
        margin-top: 40px;
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
    .btn-back {
        position: absolute;
        left: 30px;
        font-size: 20px;
        font-weight: 500;
        border: none;
        color: #000;
        background: #F2F2F2;
    }
    .btn-edit {
        position: absolute;
        right: 30px;
        border: none;
        color: #000;
        background: #F2F2F2;
        font-size: 20px;
        font-weight: 500;
    }
</style>
</html>
