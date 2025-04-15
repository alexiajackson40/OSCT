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

    <div class="main-content d-flex justify-content-center mt-5">
        <div class="users-container w-75">
            <div class="card p-4">
                <div class="card-body">
                    <h1 class="card-title mb-4">Patient Users</h1>

                    <table class="table table-hover table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>Name</th>
                                <th>Student ID</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($patients as $patient)
                                <tr>
                                    <td>{{ $patient->PACIENTE }}</td>
                                    <td>{{ $patient->getKey() }}</td>
                                    <td>
                                        <a href="{{ route('personnel.patientProfile', $patient->getKey()) }}" class="btn btn-primary btn-sm">View Profile</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</body>

<style>
    .main-content {
        width: 100%;
        min-height: 100vh;
    }
    .card-title {
        font-size: 2rem;
        font-weight: 600;
        text-align: left;
    }
    .table th, .table td {
        vertical-align: middle;
    }
    .card {
        background-color: #F2F2F2;
    }
</style>
</html>
