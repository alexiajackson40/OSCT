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
    <div id="header"></div> 
    <div class="main-content">
        <div class="form-container mt-5">
            <div class="card">
                <div class="card-body d-flex flex-column">
                    <h2>Edit Profile</h2>
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
                                <label for="phone_number">Phone Number</label>
                                <input type="text" name="phone_number" class="form-control" id="phone_number" value="{{ $user->phone_number }}" required>
                            </div>
                            <!-- Add more fields if needed -->
                        </div>
                        <button class="btn btn-primary" type="submit">Update Profile</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
