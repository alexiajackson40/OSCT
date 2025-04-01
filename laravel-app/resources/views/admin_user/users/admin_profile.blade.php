@extends('layouts.app')

@section('content')
<div class="main-content">
    <div class="profile-container mt-5">
        <div class="card">
            <div class="top-buttons d-flex flex-row align-self-center">
                <a id="back-btn" class="btn-back" href="{{ url('admin/users/admin') }}">&lt; Go Back</a>
                <button class="btn-edit">[Edit Information]</button>
            </div>
            <div class="card-body d-flex flex-column align-self-center">
                <h1 class="card-title">{{ $admin->first_name }} {{ $admin->last_name }}</h1>
                <div class="information-container d-flex flex-column align-items-left">
                    <h2 class="container-header">User Information</h2>
                    <table class="info-table">
                        <tr><td><strong>Position</strong></td><td>{{ ucfirst($admin->user_type) }}</td></tr>
                    </table>
                </div>
                <div class="contact-container d-flex flex-column align-items-left">
                    <h2 class="container-header">Contact Information</h2>
                    <table class="info-table">
                        <tr><td><strong>Email</strong></td><td>{{ $admin->email }}</td></tr>
                        <tr><td><strong>Phone #</strong></td><td>{{ $admin->phone }}</td></tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
