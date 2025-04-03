<!DOCTYPE html>
<html lang="en">
<!-- Personnel Users Page -->
<body>
    @include('layouts.header_personnel') <!-- Include the header blade -->

    <div class="main-content">
        <div class="users-container mt-5">
            <div class="card">
                <div class="card-body d-flex flex-column">
                    <div class="document-content">
                        <h1 class="card-title">Personnel Users</h1>
                        <table id="Table" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($personnel as $user)
                                    <tr>
                                        <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            <a href="{{ route('admin.users.personnelProfile', $user->id) }}" class="btn btn-primary">View Profile</a>
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

    @include('layouts.footer') <!-- Optional footer -->
</body>

<style>
    .main-content {
        display: flex;
        justify-content: center;
        width: 100%;
        align-items: center;
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
        margin-left: 25px;
        margin-right: 25px;
    }
    .card-title {
        font-size: 32px;
        font-weight: 500;
        text-align: left;
        margin-bottom: 25px;
        margin-top: 25px;
    }
    .table {
        align-items: center;
        margin-bottom: 0px;
        --bs-table-bg: #F2F2F2;
        --bs-table-border-color: #000;
    }
</style>
</html>
