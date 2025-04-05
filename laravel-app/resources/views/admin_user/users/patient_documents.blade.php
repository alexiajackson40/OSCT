<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Linking CSS and Bootstrap -->
    <link href="{{ asset('theme.css') }}" rel="stylesheet">
    <link href="{{ asset('style.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
</head>
<body>
    <!-- Include Header -->
    @include('admin_user.header_admin')

    <div class="main-content d-flex justify-content-center">
        <div class="profile-container mt-5">
            <div class="card">
                <!-- Top Buttons -->
                <div class="top-buttons d-flex flex-row">
                    <a href="{{ route('admin.patientUsers') }}" class="btn-back">&lt; Go Back</a>
                    <button class="btn-edit" data-bs-toggle="modal" data-bs-target="#uploadDocumentModal">[Upload Document]</button>
                </div>

                <!-- Document List -->
                <div class="card-body d-flex flex-column">
                    <h1 class="card-title">Patient Documents</h1>
                    <div class="documents-container d-flex flex-column">
                        <table id="Table" class="table">
                            <thead>
                                <tr>
                                    <th>Patient Name</th>
                                    <th>Document Name</th>
                                    <th>Upload Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($documents as $document)
                                    <tr>
                                        <td>{{ $document->user->first_name ?? 'N/A' }} {{ $document->user->last_name ?? '' }}</td>
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
        </div>
    </div>

    <!-- Upload Document Modal -->
    <div class="modal fade" id="uploadDocumentModal" tabindex="-1" aria-labelledby="uploadDocumentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadDocumentModalLabel">Upload New Document</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form action="{{ route('admin.uploadDocument') }}" method="POST" enctype="multipart/form-data">
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
</style>
</html>
