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
    @include('personnel_user.header_personnel')

    <div class="main-content mt-5 d-flex justify-content-center">
        <div class="profile-container">
            <div class="card">
                <!-- Edit Info and Change Password Buttons -->
                <div class="d-flex justify-content-between px-3 pt-3">
                    <button class="btn-page btn-primary" onclick="window.location='{{ route('personnel.editProfile', $user->employee_id) }}'">[Edit Information]</button>
                    <button class="btn-page btn-primary" onclick="window.location='{{ route('personnel.changePasswordForm', $user->employee_id) }}'">[Change Password]</button>
                </div>

                <div class="card-body d-flex flex-column align-items-center">
                    <h1 class="card-title">{{ $user->first_name }} {{ $user->last_name }}</h1>

                    <!-- User Information -->
                    <div class="information-container">
                        <h2 class="container-header">User Information</h2>
                        <table class="table">
                            <tr>
                                <td>First Name</td>
                                <td>{{ $user->first_name }}</td>
                            </tr>
                            <tr>
                                <td>Last Name</td>
                                <td>{{ $user->last_name }}</td>
                            </tr>
                            <tr>
                                <td>Username</td>
                                <td>{{ $user->username }}</td>
                            </tr>
                            <tr>
                                <td>Phone Number</td>
                                <td>{{ $user->phone }}</td>
                            </tr>
                        </table>
                    </div>

                    <!-- Contact Information -->
                    <div class="contact-container">
                        <h2 class="container-header">Contact Information</h2>
                        <table class="table">
                            <tr>
                                <td>Email</td>
                                <td>{{ $user->email }}</td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td>{{ $user->address ?? 'Not provided' }}</td>
                            </tr>
                        </table>
                    </div>
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
    }
    .card {
        background-color: #F2F2F2;
        width: 100%;
        max-width: 600px;
        position: relative;
    }
    .card-body {
        padding: 2rem;
    }
    .card-title {
        font-size: 2rem;
        font-weight: 600;
        margin-bottom: 2rem;
    }
    .container-header {
        font-size: 1.25rem;
        font-weight: 500;
        margin-bottom: 0.75rem;
        margin-top: 1rem;
    }
    .information-container,
    .contact-container {
        width: 100%;
        padding: 1rem;
        background: #FFF;
        border-radius: 6px;
        border: 1px solid rgba(0, 0, 0, 0.3);
        margin-bottom: 1.25rem;
    }
    .table {
        font-size: 1rem;
        color: #000;
    }
    .btn-page {
        border: none;
        background: #F2F2F2;
        font-size: 1rem;
        font-weight: 500;
        text-decoration: underline;
    }
</style>
</html>
