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
    @include('personnel_user.header_personnel')
    <div class="main-content">
        <div class="document-container mt-5">
            <div class="card">
                <div class="top-buttons d-flex flex-row align-self-center">
                    <a id="back-btn" class="btn-back" href="{{ route('personnel.users') }}">&lt; Go Back</a>
                    <button class="btn-edit" data-bs-toggle="modal" data-bs-target="#uploadLabResultModal">[Upload Lab Result]</button>
                </div>
                <div class="card-body d-flex flex-column">
                    <h1 class="card-title">Lab Results for:<br> {{ $patient->PACIENTE }}</h1>
                    <div class="document-content">
                        <table id="Table" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Lab Result Name</th>
                                    <th>Uploaded By</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($labResults as $labResult)
                                    <tr>
                                        <td>{{ $labResult->name }}</td>
                                        <td>{{ $labResult->uploaded_by }}</td>
                                        <td>
                                            <a href="{{ url('/' . $labResult->file_path) }}" target="_blank" class="btn btn-primary btn-download btn-sm">Download</a>
                                            <form action="{{ route('personnel.deleteLabResult', $labResult->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="button-container mt-5 d-flex flex-column">      
            <a class="record-btn btn-primary" role="button" href="{{ route('personnel.patientProfile', $patient->CURP) }}">Patient Profile</a>
            <a class="record-btn btn-primary" role="button" href="{{ route('personnel.patientMeasurements', $patient->CURP) }}">Measurements</a>
            <a class="record-btn btn-primary" role="button" href="{{ route('personnel.documents', $patient->CURP) }}">Documents</a>
            <a class="record-btn btn-primary active-btn" role="button" href="{{ route('personnel.patientLabResults', $patient->CURP) }}">Lab Results</a>
        </div>
    </div>
    <!-- Upload Lab Result Modal -->
    <div class="modal fade" id="uploadLabResultModal" tabindex="-1" aria-labelledby="uploadLabResultModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadLabResultModalLabel">Upload New Lab Result</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('personnel.uploadLabResult', $patient->CURP) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="lab_result">Select Lab Result</label>
                            <input type="file" name="lab_result" id="lab_result" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" class="form-control" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<style>
    /* Styling for Containers*/
    .main-content {
        display: flex;
        justify-content: center;
        width: 100%;
        min-height: 100vh;
        background-color: var(--light-surface-one);
    }
    .document-container {
        width: 70%;
    }
    .card {
        background-color: #FAFAFA;
        height: 100%;
        min-height: 100vh;
        display: flex;
        justify-content: center;
    }
    /*-----------------------------------*/
    /* Styling Title*/
    .card-title {
        font-size: 2rem;
        font-weight: 500;
        text-align: left;
        margin-bottom: 1.5625rem;
        margin-top: 2.5rem;
        margin-left: 1.5625rem;
        margin-right: 1.5625rem;
    }
    /*-----------------------------------*/
    /* Styling for Table*/
    .document-content {
        margin-left: 1.5625rem;
        margin-right: 1.5625rem;
    }
    .table {
        align-items: center;
        margin-bottom: 0rem;
        --bs-table-bg: #FAFAFA;
        --bs-table-border-color: #000;
        border: 0.063rem solid #000000;
    }
    /*-----------------------------------*/
    /* Styling for Back and Edit Buttons*/
    .btn-back {
        position: absolute;
        left: 1.875rem;
        font-size: 1.25rem;
        font-weight: 500;
        border: none;
        color: #000;
        background: #FAFAFA;
    }
    .btn-edit {
        position: absolute;
        right: 1.875rem;
        font-size: 1.25rem;
        font-weight: 500;
        border: none;
        color: #000;
        background: #FAFAFA;
    }
    .top-buttons {
        margin-top: 0.625rem;
        margin-bottom: 0.625rem;
        width: 28.063rem;
        padding-top: 0.625rem;
        display: flex;
        flex-direction: row;
    }
    /*-----------------------------------*/
    /* Styling for Side Buttons*/
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
        border-radius: 0.5rem;
        background: #7C1332;
        box-shadow: 0rem 0.25rem 0.25rem 0rem rgba(0, 0, 0, 0.25);
        color: #FFF;
        font-size: 1.25rem;
        font-weight: 500;
        text-decoration: none;
    }
    .record-btn:hover {
            background-color: #52051C;
    }
    .active-btn {
        background: #808080;
        box-shadow: 0rem 0.25rem 0.25rem 0rem rgba(0, 0, 0, 0.25) inset;
    }
    /*-----------------------------------*/
        /* Styling for Download and Delete Buttons*/
        .btn-download {
            height: 3rem;
            display: flex;
            align-items: center;
            border-radius:0.5rem;
            font-weight: 500;
            justify-content: center;
        }
        .btn-danger {
            height: 3rem;
            display: flex;
            align-items: center;
            border-radius:0.5rem;
            font-weight: 500;
            justify-content: center;
        }
        /*-----------------------------------*/
</style>
</html>
