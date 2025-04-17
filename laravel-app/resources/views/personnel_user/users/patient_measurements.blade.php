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
    <div class="main-content">
        <div class="profile-container mt-5">
            <div class="card">
                <div class="top-buttons d-flex flex-row align-self-center">
                    <a href="{{ route('personnel.users') }}" class="btn-back">&lt; Go Back</a>
                </div>
                <div class="card-body d-flex flex-column">
                    <h1 class="card-title">Patient Measurements for:<br> {{ $patient->PACIENTE }}</h1>
                    <!-- Form starts -->
                    <form action="{{ route('personnel.updateMeasurement', $patient->CURP) }}" method="POST">
                        @csrf
                        @method('PUT')
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
                                        <tr>
                                            <td>Waist</td>
                                            <td><input type="text" name="measurements[{{ $measurement->id }}][waist]" value="{{ $measurement->waist }}" class="form-control"></td>
                                            <td>{{ $measurement->created_at->format('Y-m-d') }}</td>
                                        </tr>
                                        <tr>
                                            <td>Hip</td>
                                            <td><input type="text" name="measurements[{{ $measurement->id }}][hip]" value="{{ $measurement->hip }}" class="form-control"></td>
                                            <td>{{ $measurement->created_at->format('Y-m-d') }}</td>
                                        </tr>
                                        <tr>
                                            <td>Waist-Hip Ratio</td>
                                            <td><input type="text" name="measurements[{{ $measurement->id }}][waist_hip_ratio]" value="{{ $measurement->waist_hip_ratio }}" class="form-control"></td>
                                            <td>{{ $measurement->created_at->format('Y-m-d') }}</td>
                                        </tr>
                                        <tr>
                                            <td>Body Mass</td>
                                            <td><input type="text" name="measurements[{{ $measurement->id }}][body_mass]" value="{{ $measurement->body_mass }}" class="form-control"></td>
                                            <td>{{ $measurement->created_at->format('Y-m-d') }}</td>
                                        </tr>
                                        <tr>
                                            <td>Cholesterol</td>
                                            <td><input type="text" name="measurements[{{ $measurement->id }}][cholesterol]" value="{{ $measurement->cholesterol }}" class="form-control"></td>
                                            <td>{{ $measurement->created_at->format('Y-m-d') }}</td>
                                        </tr>
                                        <tr>
                                            <td>Glucose Level</td>
                                            <td><input type="text" name="measurements[{{ $measurement->id }}][glucose_level]" value="{{ $measurement->glucose_level }}" class="form-control"></td>
                                            <td>{{ $measurement->created_at->format('Y-m-d') }}</td>
                                        </tr>
                                        <tr>
                                            <td>Hemoglobin</td>
                                            <td><input type="text" name="measurements[{{ $measurement->id }}][hemoglobin]" value="{{ $measurement->hemoglobin }}" class="form-control"></td>
                                            <td>{{ $measurement->created_at->format('Y-m-d') }}</td>
                                        </tr>
                                        <tr>
                                            <td>Triglycerides</td>
                                            <td><input type="text" name="measurements[{{ $measurement->id }}][triglycerides]" value="{{ $measurement->triglycerides }}" class="form-control"></td>
                                            <td>{{ $measurement->created_at->format('Y-m-d') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Save Changes</button>
                    </form>
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
</body>
<style>
    .main-content {
        display: flex;
        justify-content: center;
        width: 100%;
        min-height: 100vh;
    }
    .profile-container {
        width: fit-content;
    }
    .card {
        background-color: #F2F2F2;
        width: fit-content;
        height: fit-content;
        display: flex;
        justify-content: center;
    }
    .card-body {
        margin-bottom: 1rem;
        margin-left: 0.625rem;
        margin-right: 0.625rem;
        padding-top: 0.625rem;
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .top-buttons {
        margin-top: 0.625rem;
        margin-bottom: 0.625rem;
        width: 28.063rem;
        padding-top: 0.625rem;
        display: flex;
        flex-direction: row;
    }
    .card-title {
        font-size: 2rem;
        font-weight: 500;
        margin-top: 2.5rem;
        width: 40rem;
    }
    .measurements-container {
        margin-top: 0.75rem;
        width: 40rem;
        height: auto;
        border-radius: 0.375rem;
        border: 0.063rem solid rgba(0, 0, 0, 0.30);
        background: #FFF;
        display: flex;
        justify-content: left;
        align-items: left;
    }
    .table {
        margin-left: 0.875rem;
        margin-right: 0.875rem;
        color: #000000;
        font-size: 1rem;
        font-weight: 400;
        width: auto;
    }
    .button-container {
        width: 13.375rem;
        height: fit-content;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-right: 0.5rem;
        margin-left: 0.5rem;
        gap: 0.5rem;
    }
    .record-btn {
        width: 100%;
        height: 3.75rem;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 8px;
        background: #7C1332;
        box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);
        color: #FFF;
        font-size: 1.25rem;
        font-weight: 500;
        text-decoration: none;
    }
    .record-btn:hover {
            background-color: #6F1A34;
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
