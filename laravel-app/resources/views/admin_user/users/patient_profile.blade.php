@extends('layouts.app')

@section('content')
<div class="main-content d-flex align-self-center">
    <div class="profile-container mt-5">
        <div class="card">
            <div class="top-buttons d-flex flex-row align-self-center">
                <a id="back-btn" class="btn-back" href="{{ url('admin/users/patient') }}">&lt; Go Back</a>
                <button class="btn-edit">[Edit Information]</button>
            </div>
            <div class="card-body d-flex flex-column align-self-center">
                <h1 class="card-title">{{ $patient->first_name }} {{ $patient->last_name }}</h1>
                <div class="information-container d-flex flex-column align-items-left">
                    <h2 class="container-header">Patient Information</h2>
                    <table class="info-table">
                        <tr><td><strong>Patient ID</strong></td><td>{{ $patient->id }}</td></tr>
                        <tr><td><strong>Name of School</strong></td><td>{{ $patient->school_name }}</td></tr>
                        <tr><td><strong>DOB</strong></td><td>{{ $patient->dob }}</td></tr>
                        <tr><td><strong>Gender</strong></td><td>{{ $patient->gender }}</td></tr>
                    </table>
                </div>
                <div class="contact-container d-flex flex-column align-items-left">
                    <h2 class="container-header">Contact Information</h2>
                    <table class="info-table">
                        <tr><td><strong>Legal Guardian</strong></td><td>{{ $patient->guardian }}</td></tr>
                        <tr><td><strong>Phone #</strong></td><td>{{ $patient->phone }}</td></tr>
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
