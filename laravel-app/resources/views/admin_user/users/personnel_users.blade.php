<!DOCTYPE html>
<html lang="en">
<!-- List of Personnel Users -->
<body>
    <div id="header"></div>
    <div class="main-content">
        <!-- Side Buttons Container-->
        <div class="button-container mt-5 d-flex flex-column">
            <a class="table-btn btn-primary" role="button" href="{{ route('admin.users.patientUsers') }}">Patients</a>
            <a class="table-btn btn-primary" role="button" href="{{ route('admin.users.personnelUsers') }}">Personnel</a>
            <a class="table-btn btn-primary" role="button" href="{{ route('admin.users.adminUsers') }}">Admin</a>
        </div>
        <div class="users-container mt-5">
            <div class="card">
                <a class="btn-page btn-primary" href="{{ route('admin.addUser') }}">[Add/Remove User]</a>
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
                                @foreach($personnel as $person)
                                    <tr>
                                        <td>{{ $person->first_name }} {{ $person->last_name }}</td>
                                        <td>{{ $person->email }}</td>
                                        <td>
                                            <a href="{{ route('admin.users.personnelProfile', $person->id) }}" class="btn btn-primary">View Profile</a>
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
</body>

<style>
    .main-content {
        display:flex;
        justify-content:left;
        width:100%;
        min-height:100vh;
    }
    .users-container {
        width:70%;
    }
    .card {
        background-color:#F2F2F2;
        height:100%;
        min-height:100vh;
    }
    .document-content {
        margin-left:1.5625rem;
        margin-right:1.5625rem;
    }
    .card-title {
        font-size:2rem;
        font-weight:500;
        text-align:left;
        margin-bottom:1.5625rem;
        margin-top:1.5625rem;
    }
    .button-container {
        width:13.375rem;
        height:13rem;
        display:flex;
        justify-content:center;
        justify-content:space-around;
        align-items:center;
        margin-right:0.5rem;
        margin-left:0.5rem;
    }
    .table-btn {
        width:214px;
        height:60px;
        display:inline-flex;
        padding:18.5px 40px 18.5px 39px;
        justify-content:center;
        align-items:center;
        border-radius:8px;
        background:#6F1A34;
        box-shadow:0px 4px 4px 0px rgba(0, 0, 0, 0.25);
        color:#FFF;
        font-size:20px;
        font-weight:500;
    }
    .table {
        align-items:center;
        margin-bottom:0px;
        --bs-table-bg:#F2F2F2;
        --bs-table-border-color:#000;
    }
    .td a {
        display:flex;
        align-items:center;
        justify-content:center;
    }
    .btn-page {
        position:absolute;
        right:4px;
        width:214px;
        height:60px;
        border:none;
        color:#000;
        background:#F2F2F2;
        font-size:20px;
        font-weight:500;
    }
</style>
</html>
