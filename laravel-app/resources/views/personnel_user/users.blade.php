<!-- resources/views/personnel_user/users.blade.php -->
@extends('layouts.app')

@section('content')
    @include('components.header_personnel')

    <div class="main-content">
        <div class="users-container mt-5">
            <div class="card">
                <div class="card-body d-flex flex-column">
                    <h1 class="card-title">Users</h1>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID Number</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>User Type</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr onclick="window.location='{{ route('personnel.patient.profile', ['id' => $user->id]) }}'">
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->first_name }}</td>
                                    <td>{{ $user->last_name }}</td>
                                    <td>{{ $user->type }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
