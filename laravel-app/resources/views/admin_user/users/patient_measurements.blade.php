<!DOCTYPE html>
<html lang="en">
<!-- Patient Measurements Page -->
<body>
    <!-- Include the header dynamically -->
    @include('admin_user.header_admin')

    <div class="main-content d-flex align-self-center">
        <div class="profile-container mt-5">
            <div class="card">
                <div class="top-buttons d-flex flex-row align-self-center">
                    <a href="{{ route('admin.patientUsers') }}" class="btn-back">&lt; Go Back</a>
                    <button class="btn-edit" data-bs-toggle="modal" data-bs-target="#uploadMeasurementModal">[Update Measurements]</button>
                </div>
                <div class="card-body d-flex flex-column align-self-center align-items-left">
                    <h1 class="card-title">Patient Measurements</h1>
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
                                        <td>{{ $measurement->type }}</td>
                                        <td>{{ $measurement->value }}</td>
                                        <td>{{ $measurement->created_at->format('Y-m-d') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="button-container mt-5 d-flex flex-column">      
                <a class="record-btn btn-primary" role="button" href="{{ route('admin.users.patient_profile', $patient->id) }}">Patient Profile</a>
                <a class="record-btn btn-primary" role="button" href="{{ route('admin.users.patient_measurements', $patient->id) }}">Measurements</a>
                <a class="record-btn btn-primary" role="button" href="{{ route('admin.users.patient_documents', $patient->id) }}">Documents</a>
                <a class="record-btn btn-primary" role="button" href="{{ route('admin.users.patient_labResults', $patient->id) }}">Lab Results</a>
            </div>
        </div>
    </div>

    <!-- Modal for Uploading Measurement -->
    <div class="modal fade" id="uploadMeasurementModal" tabindex="-1" aria-labelledby="uploadMeasurementModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadMeasurementModalLabel">Upload New Measurement</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.uploadMeasurement', $patient->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="measurement_type">Measurement Type</label>
                            <input type="text" name="measurement_type" id="measurement_type" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="measurement_value">Value</label>
                            <input type="number" name="measurement_value" id="measurement_value" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="measurement_date">Date</label>
                            <input type="date" name="measurement_date" id="measurement_date" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

<!-- Existing Styling Preserved -->
<style>
    .main-content {
        display:flex;
        justify-content:center;
        width:100%;
        min-height:100vh;
    }
    .profile-container {
        width:70%;
        display:flex;
        justify-content:center;
    }
    .card {
        background-color:#F2F2F2;
        width:34.063rem;
        height:34.188rem;
        position:relative;
    }
    .top-buttons {
        margin-top:0.625rem;
        margin-bottom:0.625rem;
        width:28.063;
        padding-top:0.625rem;
        display:flex;
        flex-direction:row;
    }
    .card-body {
        padding-top:0.625rem;
        display:flex;
        flex-direction:column;
        width:29rem;
    }
    .card-title {
        font-size:2rem;
        font-weight:500;
        margin-top:2.5rem;
    }
    .container-header {
        font-size:1.25rem;
        font-weight:500;
        padding-left:0.875rem;
        padding-top:0.875rem;
    }
    .measurements-container {
        margin-top:0.75rem;
        width:26.688rem;
        height:10.25rem;
        border-radius:0.375rem;
        border:0.063rem solid rgba(0, 0, 0, 0.30);
        background:#FFF;
        display:flex;
        justify-content: left;
        align-items: left;
    }
    .table {
        color:#000000;
        font-size:1rem;
        font-weight:400;
    }
    .td {
        border-radius: 6px;
        border-color:#000;
        border-style: solid;
        background: #FFF;
        border-width: 1px;
    }
    .btn-back {
        position:absolute;
        left:1.875rem;
        font-size:1.25rem;
        font-weight:500;
        border:none;
        color:#000;
        background:#F2F2F2;
    }
    .btn-edit {
        position:absolute;
        right:1.875rem;
        border:none;
        color:#000;
        background:#F2F2F2;
        font-size:1.25rem;
        font-weight:500;
    }
    .button-container {
        width:13.375rem;
        height:17rem;
        display:flex;
        flex-direction: column;
        justify-content:space-between;
        margin-right:0.5rem;
        margin-left:0.5rem;
    }
    .record-btn {
        width:214px;
        height:60px;
        display:inline-flex;
        padding:18.5px 40px 18.5px 39px;
        justify-content:center;
        align-items:center;
        border-radius:8px;
        background:#6F1A34;
        box-shadow:0px 4px 4px 0px rgba(0, 0, 0, 0.25);
        color:#FFF;
        font-size:20px;
        font-weight:500;
    }
</style>
</html>
