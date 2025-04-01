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
            <a class="btn-page btn-primary" href="#">[Add/Remove User]</a>
            <div class="card-body d-flex flex-column">
                <div class="document-content">
                    <h1 class="card-title">Admin Users</h1>
                    <table class="table table-hover">
                        <thead>
                            <tr><th>ID</th><th>First</th><th>Last</th><th>Type</th></tr>
                        </thead>
                        <tbody>
                            @foreach ($admins as $user)
                                <tr class="listed-user" onclick="location.href='{{ url('admin/users/admin/profile/' . $user->id) }}';" style="cursor:pointer;">
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
