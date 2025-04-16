<!DOCTYPE html>
<html lang="en">
<head>
    <link href="{{ asset('theme.css') }}" rel="stylesheet">
    <link href="{{ asset('style.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
</head>
<body>
    @include('personnel_user.header_personnel')

    <div class="main-content d-flex justify-content-center mt-5">
        <div class="card" style="width: 500px;">
            <div class="card-body">
                <h2 class="card-title">Change Password</h2>
                <form method="POST" action="{{ route('personnel.changePassword', $user->employee_id) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="current_password" class="form-label">Current Password</label>
                        <input type="password" name="current_password" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">New Password</label>
                        <input type="password" name="password" class="form-control" required minlength="8">
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirm New Password</label>
                        <input type="password" name="password_confirmation" class="form-control" required minlength="8">
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('personnel.profile', $user->employee_id) }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">Change Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        .main-content {
            width: 100%;
            min-height: 100vh;
        }
        .card {
            background-color: #F2F2F2;
            padding: 2rem;
        }
        .card-title {
            font-size: 1.75rem;
            font-weight: 500;
            margin-bottom: 1.5rem;
        }
    </style>
</body>
</html>
