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

    <div class="main-content d-flex align-self-center">
        <div class="profile-container mt-5">
            <div class="card">
                <!-- Top Buttons -->
                <div class="top-buttons d-flex flex-row align-self-center">
                    <a href="{{ route('personnel.users') }}" class="btn-back">&lt; Go Back</a>
                    <button class="btn-edit" data-bs-toggle="modal" data-bs-target="#uploadDocumentModal">[Upload Document]</button>
                </div>

                <div class="card-body d-flex flex-column align-self-center align-items-left">
                    <h1 class="card-title">Patient Documents for {{ $patient->PACIENTE }}</h1>
                    <div class="measurements-container d-flex flex-column align-items-left">
                        <table id="Table" class="table">
                            <thead>
                                <tr>
                                    <th>Document Name</th>
                                    <th>Uploaded By</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($documents as $document)
                                    <tr>
                                        <td>{{ $document->name }}</td>
                                        <td>{{ $document->uploaded_by }}</td>
                                        <td>
                                            <a href="{{ url('/' . $document->file_path) }}" class="btn btn-primary btn-sm" target="_blank">Download</a>
                                            <form action="{{ route('personnel.deleteDocument', $document->id) }}" method="POST" style="display:inline;">
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

            <!-- Side Buttons -->
            <div class="button-container mt-5 d-flex flex-column">
                <a class="record-btn btn-primary" role="button" href="{{ route('personnel.patientProfile', $patient->CURP) }}">Patient Profile</a>
                <a class="record-btn btn-primary" role="button" href="{{ route('personnel.patientMeasurements', $patient->CURP) }}">Measurements</a>
                <a class="record-btn btn-primary" role="button" href="{{ route('personnel.documents', $patient->CURP) }}">Documents</a>
                <a class="record-btn btn-primary" role="button" href="{{ route('personnel.patientLabResults', $patient->CURP) }}">Lab Results</a>
            </div>
        </div>
    </div>

    <!-- Modal for Uploading Document -->
    <div class="modal fade" id="uploadDocumentModal" tabindex="-1" aria-labelledby="uploadDocumentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadDocumentModalLabel">Upload New Document</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('personnel.uploadDocument', $patient->CURP) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="document_name">Document Name</label>
                            <input type="text" name="document_name" id="document_name" class="form-control" required>
                        </div>
                        <div class="form-group mt-3">
                            <label for="document_file">Upload File</label>
                            <input type="file" name="document_file" id="document_file" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Upload</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

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
        .btn-edit {
            position: absolute;
            right: 1.875rem;
            font-size: 1.25rem;
            font-weight: 500;
            border: none;
            color: #000;
            background: #F2F2F2;
        }
    </style>
</body>
</html>
