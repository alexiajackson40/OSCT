<!DOCTYPE html>
<html lang="en">
<head>
    <link href="{{ asset('theme.css') }}" rel="stylesheet">
    <link href="{{ asset('style.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
</head>
<body>
    @include('personnel_user.header_personnel')

    <div class="main-content d-flex align-self-center">
        <div class="profile-container mt-5">
            <div class="card">
                <div class="top-buttons d-flex flex-row align-self-center">
                    <a href="{{ route('personnel.users') }}" class="btn-back">&lt; Go Back</a>
                </div>
                <div class="card-body d-flex flex-column align-self-center align-items-left">
                    <h1 class="card-title">Patient Measurements for {{ $patient->PACIENTE }}</h1>
                    <div class="measurements-container d-flex flex-column align-items-left">
                        <table id="Table" class="table">
                            <thead>
                                <tr>
                                    <th>Measurement Type</th>
                                    <th>Value</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($measurements as $measurement)
                                    <tr><td>Waist</td><td>{{ $measurement->waist }}</td><td>{{ $measurement->created_at->format('Y-m-d') }}</td></tr>
                                    <tr><td>Hip</td><td>{{ $measurement->hip }}</td><td>{{ $measurement->created_at->format('Y-m-d') }}</td></tr>
                                    <tr><td>Waist-Hip Ratio</td><td>{{ $measurement->waist_hip_ratio }}</td><td>{{ $measurement->created_at->format('Y-m-d') }}</td></tr>
                                    <tr><td>Body Mass</td><td>{{ $measurement->body_mass }}</td><td>{{ $measurement->created_at->format('Y-m-d') }}</td></tr>
                                    <tr><td>Cholesterol</td><td>{{ $measurement->cholesterol }}</td><td>{{ $measurement->created_at->format('Y-m-d') }}</td></tr>
                                    <tr><td>Glucose Level</td><td>{{ $measurement->glucose_level }}</td><td>{{ $measurement->created_at->format('Y-m-d') }}</td></tr>
                                    <tr><td>Hemoglobin</td><td>{{ $measurement->hemoglobin }}</td><td>{{ $measurement->created_at->format('Y-m-d') }}</td></tr>
                                    <tr><td>Triglycerides</td><td>{{ $measurement->triglycerides }}</td><td>{{ $measurement->created_at->format('Y-m-d') }}</td></tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="button-container mt-5 d-flex flex-column">      
                <a class="record-btn btn-primary" role="button" href="{{ route('personnel.patientProfile', $patient->CURP) }}">Patient Profile</a>
                <a class="record-btn btn-primary" role="button" href="{{ route('personnel.patientMeasurements', $patient->CURP) }}">Measurements</a>
                <a class="record-btn btn-primary" role="button" href="{{ route('personnel.documents', $patient->CURP) }}">Documents</a>
                <a class="record-btn btn-primary" role="button" href="{{ route('personnel.patientLabResults', $patient->CURP) }}">Lab Results</a>
            </div>
        </div>
    </div>
</body>

<style>
    .main-content {
        display: flex;
        justify-content: center;
        width: 100%;
        min-height: 100vh;
    }
    .profile-container {
        width: 70%;
        display: flex;
        justify-content: center;
    }
    .card {
        background-color: #F2F2F2;
        width: 34.063rem;
        height: auto;
        position: relative;
    }
    .top-buttons {
        margin-top: 0.625rem;
        margin-bottom: 0.625rem;
        width: 28.063rem;
        padding-top: 0.625rem;
        display: flex;
        flex-direction: row;
    }
    .card-body {
        padding-top: 0.625rem;
        display: flex;
        flex-direction: column;
        width: 29rem;
    }
    .card-title {
        font-size: 2rem;
        font-weight: 500;
        margin-top: 2.5rem;
    }
    .measurements-container {
        margin-top: 0.75rem;
        width: 26.688rem;
        height: auto;
        border-radius: 0.375rem;
        border: 0.063rem solid rgba(0, 0, 0, 0.30);
        background: #FFF;
        display: flex;
        justify-content: left;
        align-items: left;
    }
    .table {
        color: #000000;
        font-size: 1rem;
        font-weight: 400;
    }
    .button-container {
        width: 13.375rem;
        height: auto;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        gap: 0.5rem;
        margin-right: 0.5rem;
        margin-left: 0.5rem;
    }
    .record-btn {
        width: 214px;
        height: 60px;
        display: inline-flex;
        padding: 18.5px 40px;
        justify-content: center;
        align-items: center;
        border-radius: 8px;
        background: #6F1A34;
        box-shadow: 0 4px 4px rgba(0,0,0,0.25);
        color: #FFF;
        font-size: 20px;
        font-weight: 500;
    }
    .btn-back {
        position: absolute;
        left: 1.875rem;
        font-size: 1.25rem;
        font-weight: 500;
        border: none;
        color: #000;
        background: #F2F2F2;
    }
</style>
</html>
