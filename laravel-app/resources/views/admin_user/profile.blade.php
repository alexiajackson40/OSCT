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
    @include('admin_user.header_admin') 
    <div class="main-content">
        <div class="profile-container mt-5">
            <div class="card">
                <!-- Buttons -->
                <div class="d-flex justify-content-between px-3 pt-3">
                    <button class="btn-page btn-primary" onclick="window.location='{{ route('admin.editProfile') }}'">[Edit Information]</button>
                    <button class="btn-page btn-warning" onclick="window.location='{{ route('admin.changePassword') }}'">[Change Password]</button>
                </div>
                <div class="card-body d-flex flex-column">
                    <h1 class="card-title">{{ $user->first_name }} {{ $user->last_name }}</h1>
                    <div class="information-container d-flex flex-column">
                        <h2 class="container-header align-self-left">User Information</h2>
                        <table class="table">
                            <tr>
                                <td>Username</td>
                                <td>{{ $user->username }}</td>
                            </tr>
                            <tr>
                                <td>Role</td>
                                <td>{{ ucfirst($user->role) }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="contact-container d-flex flex-column">
                        <h2 class="container-header align-self-left">Contact Information</h2>
                        <table class="table">
                            <tr>
                                <td>Phone</td>
                                <td>{{ $user->phone }}</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>{{ $user->email }}</td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td>{{ $user->address }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/loadContent.js') }}"></script>
    <script type="module" src="{{ asset('js/main.js') }}"></script>
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
        padding: 2rem;
    }
    .information-container,
    .contact-container {
        margin-top: 0.75rem;
        width: 28.063rem;
        height: auto;
        border-radius: 0.375rem;
        border: 0.063rem solid rgba(0,0,0,0.30);
        background: white;
        display: flex;
        justify-content: center;
    }
    /*-----------------------------------*/
    /* Styling for Edit and Change Password Buttons*/
    .btn-page {
        border: none;
        background: #FAFAFA;
        font-size: 1.25rem;
        font-weight: 500;
        text-decoration: underline;
    }
    /*-----------------------------------*/
    /* Styling for Card Title and Container Headers*/
    .card-title {
        font-size: 2rem;
        font-weight: 500;
        margin-bottom: 1.5rem;
        width: 28.063rem;
    }
    .container-header {
        font-size: 1.25rem;
        font-weight: 500;
        padding-left: 0.875rem;
        padding-top: 0.875rem;
    }
    /*-----------------------------------*/
    /* Styling for Table*/
    .table {
        margin-left: 0.875rem;
        margin-right: 0.875rem;
        font-size: 1rem;
        color: #000;
        font-weight: 400;
        width: auto;
    }
    /*-----------------------------------*/
</style>
</html>