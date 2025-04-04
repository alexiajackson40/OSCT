<!DOCTYPE html>
<html lang="en">
<body>
    <!-- Include the header -->
    @include('admin_user.header_admin')
    <div class="main-content">
        <!-- Side Buttons Container -->
        <div class="button-container mt-5 d-flex flex-column">
            <!-- Update the route names to match the correct routes -->
            <a class="table-btn" role="button" href="{{ route('admin.patient_users') }}">Patients</a>
            <a class="table-btn" role="button" href="{{ route('admin.personnel_users') }}">Personnel</a>
            <a class="table-btn" role="button" href="{{ route('admin.admin_users') }}">Admin</a>
        </div>

        <!-- Users Container -->
        <div class="users-container mt-5">
            <div class="card">
                <a id="add-btn" class="btn-page" href="{{ route('admin.addUser') }}">[Add/Remove User]</a>
                <div class="card-body d-flex flex-column">
                    <div class="document-content">
                        <h1 class="card-title">Users</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Main Content Styling */
        .main-content {
            margin-top: 6rem; /* Add spacing below the header */
            display: flex;
            justify-content: flex-start;
            align-items: flex-start;
            padding: 1rem;
            width: 100%;
            min-height: 100vh;
        }

        /* Users Container Styling */
        .users-container {
            flex-grow: 1;
            width: 70%;
            background-color: white;
            border-radius: 0.5rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card {
            background-color: #F2F2F2;
            padding: 1rem;
        }

        .document-content {
            margin: 1.5rem;
        }

        .card-title {
            font-size: 2rem;
            font-weight: 500;
            text-align: left;
            margin-bottom: 1.5rem;
        }

        /* Button Container Styling */
        .button-container {
            width: 15rem;
            display: flex;
            flex-direction: column;
            gap: 1rem; /* Space between buttons */
            margin-right: 1rem;
        }

        /* Table Button Styling */
        .table-btn {
            width: 100%;
            height: 3.75rem;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 8px;
            background-color: #6F1A34; /* Dark red */
            box-shadow: 0 4px 4px rgba(0, 0, 0, 0.25);
            color: #FFF;
            font-size: 1.25rem;
            font-weight: 500;
            text-decoration: none;
        }

        .table-btn:hover {
            background-color: #7C1332; /* Slightly lighter shade of red */
        }

        /* Add/Remove Button Styling */
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
