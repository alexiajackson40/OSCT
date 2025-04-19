<!DOCTYPE html>
<html lang="en">
<head>
     <!-- Import Bootstrap and Custom Styles -->
     <link href="{{ asset('theme.css') }}" rel="stylesheet">
     <link href="{{ asset('style.css') }}" rel="stylesheet">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
</head>
<!-- Edit Profile Page -->
<body>
    @include('admin_user.header_admin')
    <div class="main-content">
        <div class="form-container mt-5">
            <div class="card">
                <div class="card-body d-flex flex-column">
                    <h2 class="card-title">Edit Profile</h2>
                    <form method="POST" action="{{ route('update.profile') }}" class="needs-validation" novalidate>
                        @csrf
                        @method('PUT')
                        <div class="form-row">
                            <div class="mb-3">
                                <label for="first_name">First Name</label>
                                <input type="text" name="first_name" class="form-control" id="first_name" value="{{ $user->first_name }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="last_name">Last Name</label>
                                <input type="text" name="last_name" class="form-control" id="last_name" value="{{ $user->last_name }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="username">Username</label>
                                <input type="text" name="username" class="form-control" id="username" value="{{ $user->username }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" id="email" value="{{ $user->email }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="phone">Phone Number</label>
                                <input type="text" name="phone" class="form-control" id="phone" value="{{ $user->phone }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="address">Address</label>
                                <input type="text" name="address" class="form-control" id="address" value="{{ $user->address }}" required>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Update Profile</button>
                    </form>
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
    .form-container {
        width: 100%;
        display: flex;
        justify-content: center;
    }
    .card-body {
        padding: 2rem;
    }
    .card {
        width: 30%;
        height: fit-content;
    }
    /*-----------------------------------*/
    /* Styling Title*/
    .card-title {
        font-size: 1.75rem;
        font-weight: 500;
        margin-bottom: 1.5rem;
    }
    /*-----------------------------------*/
    /* Styling for Submit Button*/
    .btn-primary {
        height: 3rem;
        border-radius:0.5rem;
        font-weight: 500;
    }
    /*-----------------------------------*/
</style>
</html>
