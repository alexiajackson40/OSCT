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
    <!-- Include the header -->
    @include('admin_user.header_admin')
    <div class="main-content">
        <!-- Side Buttons Container -->
        <div class="button-container mt-5 d-flex flex-column">
            <!-- Correct route names to match the defined routes -->
            <a class="table-btn" role="button" href="{{ route('admin.patientUsers') }}">Patients</a>
            <a class="table-btn" role="button" href="{{ route('admin.personnelUsers') }}">Personnel</a>
            <a class="table-btn" role="button" href="{{ route('admin.adminUsers') }}">Admin</a>
        </div>

        <!-- Users Container -->
        <div class="users-container mt-5">
            <div class="card">
                <a id="add-btn" class="btn-page" href="{{ route('admin.addUser') }}">[Add User]</a>
                <div class="card-body d-flex flex-column">
                    <div class="document-content">
                        <h1 class="card-title">Users</h1>
                        <table class="table">
                            <thead class="tHead">
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody class="tBody">
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ ucfirst($user->role) }}</td> <!-- Display role (admin, personnel, patient) -->
                                        <td>
                                            <a href="{{ route('admin.users.edit', $user->getKey()) }}" class="btn btn-warning">Edit</a>
                                            <form action="{{ route('admin.users.destroy', $user->getKey()) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
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
            width: 100%;
            height: 3.75rem;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 8px;
            background-color: #6F1A34;
            box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);
            color: #FFF;
            font-size: 1.25rem;
            font-weight: 500;
            text-decoration: none;
        }

        .table-btn:hover {
            background-color: #7C1332;
        }
        .table {
            align-items: center;
            margin-bottom: 0px;
            --bs-table-bg: #F2F2F2;
            --bs-table-border-color: #000;
    }
        .btn-page {
            position: absolute;
            right: 4px;
            padding: 0.5rem 1rem;
            background-color: #F2F2F2;
            color: #000;
            font-size: 1rem;
            font-weight: 500;
            border: none;
            border-radius: 4px;
            text-decoration: none;
        }

        .btn-page:hover {
            background-color: #E0E0E0;
        }
    </style>

    <script src="{{ asset('js/loadContent.js') }}"></script>
    <script type="module" src="{{ asset('js/main.js') }}"></script>
</body>
</html>
