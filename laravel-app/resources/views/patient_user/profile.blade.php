@extends('layouts.app')

@section('content')
<div class="main-content">
    <div class="profile-container mt-5">
        <div class="card">
            <div class="card-body d-flex flex-column align-self-center">
                <h1 class="card-title">Patient Name</h1>
                <div class="information-container d-flex flex-column align-items-left">
                    <h2 class="container-header">Patient Information</h2>
                    <table class="info-table">
                        <tr><td><strong>Patient ID</strong></td><td>xxxxxxxxxx</td></tr>
                        <tr><td><strong>Name of School</strong></td><td>School Name</td></tr>
                        <tr><td><strong>DOB</strong></td><td>Month/Day/Year</td></tr>
                        <tr><td><strong>Gender</strong></td><td>Male/Female</td></tr>
                    </table>
                </div>
                <div class="contact-container d-flex flex-column align-items-left">
                    <h2 class="container-header">Contact Information</h2>
                    <table class="info-table">
                        <tr><td><strong>Legal Guardian</strong></td><td>Name of Legal Guardian</td></tr>
                        <tr><td><strong>Phone #</strong></td><td>(xxx)xxx-xxxx</td></tr>
                    </table>
                </div>
                <a class="btn btn-primary mt-4" href="{{ route('patient.measurements') }}">Measurements</a>
            </div>
        </div>
    </div>
</div>
@endsection
