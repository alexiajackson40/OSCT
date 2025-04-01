@extends('layouts.app')

@section('content')
<div class="main-content">
    <div class="button-container mt-5 d-flex flex-column">
        <a class="table-btn btn-primary" href="{{ url('admin/users/patient') }}">Patients</a>
        <a class="table-btn btn-primary" href="{{ url('admin/users/personnel') }}">Personnel</a>
        <a class="table-btn btn-primary" href="{{ url('admin/users/admin') }}">Admin</a>
    </div>
    <div class="users-container mt-5">
        <div class="card">
            <button class="btn-page btn-primary">[Add/Remove User]</button>
            <div class="card-body d-flex flex-column">
                <div class="document-content">
                    <h1 class="card-title">Patient Users</h1>
                    <table class="table table-hover">
                        <thead>
                            <tr><th>ID Number</th><th>First Name</th><th>Last Name</th><th>User Type</th></tr>
                        </thead>
                        <tbody>
                            @foreach ($patients as $user)
                                <tr class="listed-user" onclick="location.href='{{ url('admin/users/patient/profile/' . $user->id) }}';" style="cursor:pointer;">
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->first_name }}</td>
                                    <td>{{ $user->last_name }}</td>
                                    <td>{{ ucfirst($user->user_type) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
