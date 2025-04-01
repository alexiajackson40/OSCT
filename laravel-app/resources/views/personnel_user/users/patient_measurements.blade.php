@extends('layouts.app')

@section('content')
<div class="main-content d-flex align-self-center">
    <div class="profile-container mt-5">
        <div class="card">
            <div class="top-buttons d-flex flex-row align-self-center">
                <a href="{{ url('/admin_user/users/patient_users') }}" class="btn-back">&lt; Go Back</a>
                <button class="btn-edit">[Update Measurements]</button>
            </div>
            <div class="card-body d-flex flex-column align-self-center align-items-left">
                <h1 class="card-title">Patient Measurements</h1>
                <div class="measurements-container d-flex flex-column align-items-left">
                    <table class="info-table">
                        <tr><td><strong>Waist:</strong></td><td>xxx cm</td></tr>
                        <tr><td><strong>Hip:</strong></td><td>xxx cm</td></tr>
                        <tr><td><strong>Waist to Hip Ratio:</strong></td><td>###</td></tr>
                        <tr><td><strong>Body Mass:</strong></td><td>###</td></tr>
                        <tr><td><strong>Cholesterol:</strong></td><td>x mg/dL</td></tr>
                        <tr><td><strong>Glucose Level:</strong></td><td>x mg/dL</td></tr>
                        <tr><td><strong>Hemoglobin:</strong></td><td>xxx %</td></tr>
                        <tr><td><strong>Triglycerides:</strong></td><td>x mg/dL</td></tr>
                    </table>
                </div>
            </div>
        </div>
        @include('admin_user.users.partials.patient_nav')
    </div>
</div>
@endsection
