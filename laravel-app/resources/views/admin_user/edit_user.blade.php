<!DOCTYPE html>
<html lang="en">
<head>
    <link href="{{ asset('theme.css') }}" rel="stylesheet">
    <link href="{{ asset('style.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    @include('admin_user.header_admin')

    <div class="main-content d-flex justify-content-center mt-5">
        <div class="card" style="width: 60%;">
            <div class="card-body">
                <h1 class="card-title">Edit User</h1>

                @php
                    $userId = $user->id ?? $user->employee_id;
                @endphp

                <form action="{{ route('admin.users.update', $userId) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" class="form-control" name="first_name" value="{{ $user->first_name }}">
                    </div>

                    <div class="mb-3">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" class="form-control" name="last_name" value="{{ $user->last_name }}">
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" name="email" value="{{ $user->email }}">
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" class="form-control" name="phone" value="{{ $user->phone }}">
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.users') }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        .main-content {
            min-height: 100vh;
            width: 100%;
        }

        .card {
            background-color: #F2F2F2;
            padding: 2rem;
        }

        .card-title {
            font-size: 2rem;
            font-weight: 500;
            margin-bottom: 1.5rem;
        }
    </style>
</body>
</html>
