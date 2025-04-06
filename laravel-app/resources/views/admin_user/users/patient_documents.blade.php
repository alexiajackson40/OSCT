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
        <!-- Sidebar with navigation buttons -->
        <div class="sidebar">
            <a href="{{ route('admin.users.patient_profile', $patient->id) }}" class="btn btn-secondary">Patient Profile</a>
            <a href="{{ route('admin.users.patient_measurements', $patient->id) }}" class="btn btn-secondary">Measurements</a>
            <a href="{{ route('admin.users.patient_documents', $patient->id) }}" class="btn btn-secondary">Documents</a>
            <a href="{{ route('admin.users.patient_labResults', $patient->id) }}" class="btn btn-secondary">Lab Results</a>
        </div>

        <!-- Main Content (Patient Documents) -->
        <div class="content">
            <div class="profile-container mt-5">
                <div class="card">
                    <div class="top-buttons d-flex flex-row align-self-center">
                        <a href="{{ route('admin.patientUsers') }}" class="btn-back">&lt; Go Back</a>
                        <button class="btn-edit" data-bs-toggle="modal" data-bs-target="#uploadDocumentModal">[Upload Document]</button>
                    </div>

                    <!-- Document List -->
                    <div class="card-body d-flex flex-column">
                        <h1 class="card-title">Patient Documents for {{ $patient->first_name }} {{ $patient->last_name }}</h1>
                        <div class="documents-container d-flex flex-column">
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
    </div>
</body>

<style>
    .main-content {
        display: flex;
        justify-content: center;
        min-height: 100vh;
    }
    .profile-container {
        width: 70%;
    }
    .card {
        background-color: #F2F2F2;
        width: 100%;
        padding: 1rem;
    }
    .top-buttons {
        margin-bottom: 1rem;
        display: flex;
        justify-content: space-between;
    }
    .card-title {
        font-size: 2rem;
        margin-bottom: 1rem;
        text-align: center;
    }
    .documents-container {
        margin-top: 1rem;
    }
    .table {
        font-size: 1rem;
    }
    .btn-back {
        font-size: 1rem;
        color: #000;
    }
    .btn-edit {
        font-size: 1rem;
        background-color: #6F1A34;
        color: #fff;
    }
    .sidebar {
        width: 200px;
        padding: 20px;
        background-color: #f8f9fa;
        position: fixed;
        top: 0;
        left: 0;
        height: 100vh;
    }
    .sidebar .btn {
        margin-bottom: 10px;
        text-align: left;
        font-size: 1rem;
        color: #000;
        background-color: #f8f9fa;
    }
</style>
</html>
