<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Import Bootstrap and Custom Styles -->
    <link href="{{ asset('theme.css') }}" rel="stylesheet">
    <link href="{{ asset('style.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
</head>
<!-- List of Personnel Users -->
<body>
    <!-- Include the header dynamically -->
    @include('admin_user.header_admin')

    <div class="main-content">
        <!-- Side Buttons Container -->
        <div class="button-container mt-5 d-flex flex-column">
            <a class="table-btn btn-primary" role="button" href="{{ route('admin.patientUsers') }}">Patients</a>
            <a class="table-btn btn-primary" role="button" href="{{ route('admin.personnelUsers') }}">Personnel</a>
            <a class="table-btn btn-primary" role="button" href="{{ route('admin.adminUsers') }}">Admin</a>
        </div>

        <div class="users-container mt-5">
            <div class="card">
                <!-- Add/Remove User -->
                <a class="btn-page btn-primary" href="{{ route('admin.addUser') }}">[Add Personnel]</a>
                <div class="card-body d-flex flex-column">
                    <div class="document-content">
                        <h1 class="card-title">Personnel</h1>
                        <!-- Table List -->
                        <table id="Table" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($personnel as $person)
                                    <tr>
                                        <td>{{ $person->first_name }} {{ $person->last_name }}</td>
                                        <td>{{ $person->email }}</td>
                                        <td class="d-flex gap-2">
                                            <a href="{{ route('admin.users.personnel_profile', $person->getKey()) }}" class="btn btn-primary btn-action">View</a>

                                            <form action="{{ route('admin.removePersonnel', $person->getKey()) }}" method="POST" onsubmit="return confirm('Are you sure you want to remove this personnel user?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-action">Remove</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Existing Styling Preserved -->
    <style>
        .main-content {
            display: flex;
            justify-content: left;
            width: 100%;
            min-height: 100vh;
        }
        .users-container {
            width: 70%;
        }
        .card {
            background-color: #F2F2F2;
            height: 100%;
            min-height: 100vh;
        }
        .document-content {
            margin-left: 1.5625rem;
            margin-right: 1.5625rem;
        }
        .card-title {
            font-size: 2rem;
            font-weight: 500;
            text-align: left;
            margin-bottom: 1.5625rem;
            margin-top: 1.5625rem;
        }
        .button-container {
            width: 13.375rem;
            height: 13rem;
            display: flex;
            justify-content: center;
            justify-content: space-around;
            align-items: center;
            margin-right: 0.5rem;
            margin-left: 0.5rem;
        }
        .table-btn {
            width: 214px;
            height: 60px;
            display: inline-flex;
            padding: 18.5px 40px 18.5px 39px;
            justify-content: center;
            align-items: center;
            border-radius: 8px;
            background: #6F1A34;
            box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);
            color: #FFF;
            font-size: 20px;
            font-weight: 500;
        }
        .table {
            align-items: center;
            margin-bottom: 0px;
            --bs-table-bg: #F2F2F2;
            --bs-table-border-color: #000;
        }
        .td a {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .btn-page {
            position: absolute;
            right: 4px;
            width: 214px;
            height: 60px;
            border: none;
            color: #000;
            background: #F2F2F2;
            font-size: 20px;
            font-weight: 500;
        }
        .btn-action {
            min-width: 90px;
            font-size: 14px;
            padding: 6px 12px;
        }
    </style>
</body>
</html>
