<!DOCTYPE html>
<html lang="en">
<head>
    <link href="{{ asset('theme.css') }}" rel="stylesheet">
    <link href="{{ asset('style.css') }}" rel="stylesheet">
    <script src="{{ asset('bootstrap.min.js') }}" defer></script>
    <script src="{{ asset('loadContent.js') }}" defer></script>
</head>
<body>
    <!-- Include the header -->
    @include('admin_user.header_admin')

    <div class="main-content d-flex justify-content-center">
        <div class="profile-container mt-5">
            <div class="card">
                <!-- Top Buttons -->
                <div class="top-buttons d-flex flex-row">
                    <a href="{{ route('admin.users.patient_users') }}" class="btn-back">&lt; Go Back</a>
                    <button class="btn-edit" data-bs-toggle="modal" data-bs-target="#uploadDocumentModal">[Upload Document]</button>
                </div>

                <!-- Document List -->
                <div class="card-body d-flex flex-column">
                    <h1 class="card-title">Patient Documents</h1>
                    <div class="documents-container d-flex flex-column">
                        <table id="Table" class="table">
                            <thead>
                                <tr>
                                    <th>Document Name</th>
                                    <th>Upload Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($documents as $document)
                                    <tr>
                                        <td>{{ $document->name }}</td>
                                        <td>{{ $document->created_at->format('Y-m-d') }}</td>
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

            <!-- Navigation Buttons -->
            <div class="button-container mt-5 d-flex flex-column">
                <a class="record-btn btn-primary" role="button" href="{{ route('admin.users.patient_profile', $patient->id) }}">Patient Profile</a>
                <a class="record-btn btn-primary" role="button" href="{{ route('admin.users.patient_measurements', $patient->id) }}">Measurements</a>
                <a class="record-btn btn-primary" role="button" href="{{ route('admin.users.patient_documents', $patient->id) }}">Documents</a>
                <a class="record-btn btn-primary" role="button" href="{{ route('admin.users.patient_labResults', $patient->id) }}">Lab Results</a>
            </div>
        </div>
    </div>

    <!-- Modal for Uploading Documents -->
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
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </form>
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
        background-color: var(--light-surface-one);
        border-radius: 8px;
        padding: 1.5rem;
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
        background-color: var(--light-surface-three);
        color: #000;
    }
    .record-btn {
        margin-top: 0.5rem;
        text-align: center;
    }
</style>
</html>
