<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Import Bootstrap and Custom Styles -->
    <link href="{{ asset('theme.css') }}" rel="stylesheet">
    <link href="{{ asset('style.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
</head>
<!-- Patient Documents Page -->
<body>
    <!-- Include the header dynamically -->
    @include('admin_user.header_admin')

    <div class="main-content d-flex">
        <!-- Main Content (Patient Documents) -->
        <div class="content">
            <div class="profile-container mt-5">
                <div class="card">
                    <!-- Top Buttons (Go Back and Upload Document) -->
                    <div class="top-buttons d-flex flex-row justify-content-between align-items-center">
                        <a href="{{ route('admin.patientUsers') }}" class="btn-back">&lt; Go Back</a>
                        <button class="btn-edit" data-bs-toggle="modal" data-bs-target="#uploadDocumentModal">[Upload Document]</button>
                    </div>

                    <!-- Document List -->
                    <div class="card-body d-flex flex-column position-relative">
                        <h1 class="card-title">Patient Documents for {{ $patient->first_name }} {{ $patient->last_name }}</h1>
                        <div class="documents-container">
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
                                            <a href="{{ route('admin.downloadDocument', $document->id) }}" class="btn btn-primary btn-sm">Download</a>
                                            <form action="{{ route('admin.deleteDocument', $document->id) }}" method="POST" style="display:inline;">
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

                        <!-- Move the button-container here -->
                        <div class="button-container">
                            <a class="record-btn btn-primary" role="button" href="{{ route('admin.users.patient_profile', $patient->id) }}">Patient Profile</a>
                            <a class="record-btn btn-primary" role="button" href="{{ route('admin.users.patient_measurements', $patient->id) }}">Measurements</a>
                            <a class="record-btn btn-primary" role="button" href="{{ route('admin.users.patient_documents', $patient->id) }}">Documents</a>
                            <a class="record-btn btn-primary" role="button" href="{{ route('admin.users.patient_labResults', $patient->id) }}">Lab Results</a>
                        </div>
                    </div>
                </div>
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
                    <form action="{{ route('admin.uploadDocument', $patient->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="document_name">Document Name</label>
                            <input type="text" name="document_name" id="document_name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="document_file">Upload File</label>
                            <input type="file" name="document_file" id="document_file" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Upload</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

<style>
    .main-content{
        margin-top:2rem;
        display:flex;
        justify-content:center;
        width: 100%;
        min-height:100vh;
    }
    .document-container{
        width:70%;
    }
    .card{
        background-color:#F2F2F2;
        height:100%;
        min-height:100vh;
    }
    .document-content{
        margin-left:1.5625rem;
        margin-right:1.5625rem;
    }
    .card-title{
        font-size:2rem;
        font-weight:500;
        text-align:left;
        margin-bottom:1.125rem;
        margin-top:1.563rem;
    }
    .table{
        margin-bottom:0px;
        --bs-table-bg:#F2F2F2;
        --bs-table-border-color:#000;
        align-items:center;

    }
    .td a{
        display:flex;
        align-items:center;
        justify-content:center;
        color:#000;
    }
    .table-title{
        font-size:1.25rem;
        margin-bottom:1.563rem;
    }
    .button-container {
        position: absolute;
        top: 0px; /* Adjust for desired vertical alignment */
        left: 100%; /* This moves the buttons to the right of the table */
        margin-left: 15px; /* Add spacing between the table and buttons */
        display: flex;
        flex-direction: column;
        align-items: flex-start; /* Align buttons to the left inside the container */
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
        margin-bottom: 5px;
    }
    .top-buttons {
        margin-top:0.625rem;
        margin-bottom:0.625rem;
        width:28.063;
        padding-top:0.625rem;
        display:flex;
        flex-direction:row;
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
</style>
</html>
