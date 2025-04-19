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
    @include('admin_user.header_admin')
    <div class="main-content">
        <div class="profile-container mt-5">
            <div class="card">
                <div class="top-buttons d-flex flex-row align-self-center">
                    <a href="{{ route('admin.personnelUsers') }}" class="btn-back">&lt; Go Back</a>
                    <button class="btn-edit" data-bs-toggle="modal" data-bs-target="#editPersonnelModal">[Edit Information]</button>
                </div>
                <div class="card-body d-flex flex-column">
                    <h1 class="card-title">{{ $personnel->first_name }} {{ $personnel->last_name }}</h1>
                    <div class="information-container d-flex flex-column align-items-left">
                        <h2 class="container-header">Personnel Information</h2>
                        <table class="table">
                            <tr>
                                <td><strong>Employee ID:</strong></td>
                                <td>{{ $personnel->employee_id }}</td>
                            </tr>
                            <tr>
                                <td><strong>Phone Number:</strong></td>
                                <td>{{ $personnel->phone }}</td>
                            </tr>
                            <tr>
                                <td><strong>Username:</strong></td>
                                <td>{{ $personnel->username }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="contact-container d-flex flex-column align-items-left">
                        <h2 class="container-header">Contact Information</h2>
                        <table class="table">
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
                    <form action="{{ route('admin.updatePersonnel', $personnel->employee_id) }}" method="POST">
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
                            <label for="phone">Phone Number</label>
                            <input type="text" name="phone" value="{{ $personnel->phone }}" class="form-control">
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
        margin-bottom: 1rem;
        margin-left: 0.625rem;
        margin-right: 0.625rem;
        padding-top: 0.625rem;
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    /*-----------------------------------*/
    /* Styling for Back and Edit Buttons*/
    .top-buttons {
        margin-top: 0.625rem;
        margin-bottom: 0.625rem;
        width: 28.063rem;
        padding-top: 0.625rem;
        display: flex;
        flex-direction: row;
    }
    .btn-back {
        position: absolute;
        left: 1.875rem;
        font-size: 1.25rem;
        font-weight: 500;
        border: none;
        color: #000;
        background: #FAFAFA;
        border-radius: 1rem;
        text-decoration: none;
    }
    .btn-back:hover {
        background-color: #E0E0E0;
    }
    .btn-edit {
        position: absolute;
        right: 1.875rem;
        border: none;
        color: #000;
        background: #FAFAFA;
        font-size: 1.25rem;
        font-weight: 500;
        border-radius: 1rem;
    }
    .btn-edit:hover {
        background-color: #E0E0E0;
    }
    /*-----------------------------------*/
    /* Styling Title*/
    .card-title {
        font-size: 2rem;
        font-weight: 500;
        margin-top: 2.5rem;
        width: 28.063rem;
    }
    /*-----------------------------------*/
    /* Styling for Table*/
    .container-header {
        font-size: 1.25rem;
        font-weight: 500;
        padding-left: 0.875rem;
        padding-top: 0.875rem;
    }
    .information-container,
    .contact-container {
        margin-top: 0.75rem;
        width: 28.063rem;
        height: auto;
        border-radius: 0.375rem;
        border: 0.063rem solid rgba(0,0,0,0.30);
        background: #FFF;
    }
    /*Contact Container needs to go here */
    .table {
        margin-left: 0.875rem;
        color: #000;
        font-size: 1rem;
        font-weight: 400;
        width: auto;
    }
    /*-----------------------------------*/
</style>
</html>
