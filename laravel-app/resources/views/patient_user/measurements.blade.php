<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Import Bootstrap and Custom Styles -->
    <link href="{{ asset('theme.css') }}" rel="stylesheet">
    <link href="{{ asset('style.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
</head>

<body>
@include('layouts.header_patient')

<div class="container mt-5">
    <h2 class="mb-4">Your Measurements</h2>

    @if($measurements->isEmpty())
        <p>No measurements available.</p>
    @else
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Waist</th>
                    <th>Hip</th>
                    <th>Waist-Hip Ratio</th>
                    <th>Body Mass</th>
                    <th>Cholesterol</th>
                    <th>Glucose</th>
                    <th>Hemoglobin</th>
                    <th>Triglycerides</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($measurements as $m)
                    <tr>
                        <td>{{ $m->created_at->format('Y-m-d') }}</td>
                        <td>{{ $m->waist ?? '—' }}</td>
                        <td>{{ $m->hip ?? '—' }}</td>
                        <td>{{ $m->waist_hip_ratio ?? '—' }}</td>
                        <td>{{ $m->body_mass ?? '—' }}</td>
                        <td>{{ $m->cholesterol ?? '—' }}</td>
                        <td>{{ $m->glucose_level ?? '—' }}</td>
                        <td>{{ $m->hemoglobin ?? '—' }}</td>
                        <td>{{ $m->triglycerides ?? '—' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
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
    justify-content: flex-start; /* Adjust alignment */
    gap: 0.5rem; /* Adds a gap of 0.5rem between buttons */
    margin-right: 0.5rem;
    margin-left: 0.5rem;
    }
    .record-btn {
        width: 214px;
        height: 60px;
        display: inline-flex;
        padding: 18.5px 40px 18.5px 39px;
        justify-content: center;
        align-items: center;
        border-radius: 8px;
        background: #6F1A34;
        box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);
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

