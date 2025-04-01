@extends('layouts.app')

@section('content')
<div class="main-content d-flex align-self-center">
    <div class="profile-container mt-5">
        <div class="card">
            <div class="top-buttons d-flex flex-row align-self-center">
                <a id="back-btn" class="btn-back" href="{{ url('admin/users/patient') }}">&lt; Go Back</a>
                <button class="btn-edit">[Update Measurements]</button>
            </div>
            <div class="card-body d-flex flex-column align-self-center align-items-left">
                <h1 class="card-title">Patient Measurements</h1>
                <div class="measurements-container d-flex flex-column align-items-left">
                    <table class="info-table">
                        <tr><td><strong>Waist:</strong></td><td>{{ $measurement->waist }} cm</td></tr>
                        <tr><td><strong>Hip:</strong></td><td>{{ $measurement->hip }} cm</td></tr>
                        <tr><td><strong>Waist to Hip Ratio:</strong></td><td>{{ $measurement->waist_hip_ratio }}</td></tr>
                        <tr><td><strong>Body Mass:</strong></td><td>{{ $measurement->body_mass }}</td></tr>
                        <tr><td><strong>Cholesterol:</strong></td><td>{{ $measurement->cholesterol }} mg/dL</td></tr>
                        <tr><td><strong>Glucose Level:</strong></td><td>{{ $measurement->glucose_level }} mg/dL</td></tr>
                        <tr><td><strong>Hemoglobin:</strong></td><td>{{ $measurement->hemoglobin }} %</td></tr>
                        <tr><td><strong>Triglycerides:</strong></td><td>{{ $measurement->triglycerides }} mg/dL</td></tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="button-container mt-5 d-flex flex-column">
            <a class="record-btn btn-primary" href="{{ url('admin/users/patient/profile') }}">Patient Profile</a>
            <a class="record-btn btn-primary" href="{{ url('admin/users/patient/measurements') }}">Measurements</a>
            <a class="record-btn btn-primary" href="{{ url('admin/users/patient/documents') }}">Documents</a>
            <a class="record-btn btn-primary" href="{{ url('admin/users/patient/lab-results') }}">Lab Results</a>
        </div>
    </div>
</div>
@endsection
