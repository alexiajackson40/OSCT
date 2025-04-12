<!DOCTYPE html>
<html lang="en">
<head>
     <!-- Import Bootstrap and Custom Styles -->
     <link href="{{ asset('theme.css') }}" rel="stylesheet">
     <link href="{{ asset('style.css') }}" rel="stylesheet">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
</head>
<!-- Patient Lab Results Content -->
<body>
    <!-- Include the header dynamically -->
    @include('admin_user.header_admin')

    <div class="main-content">
        <div class="document-container mt-5">
            <div class="card">
                <div class="top-buttons d-flex flex-row align-self-center">
                    <a id="back-btn" class="btn-back" href="{{ route('admin.patientUsers') }}">&lt; Go Back</a>
                    <button class="btn-edit" data-bs-toggle="modal" data-bs-target="#uploadLabResultModal">[Upload Lab Result]</button>
                </div>
                <div class="card-body d-flex flex-column">
                    <div class="document-content">
                        <h1 class="card-title">Lab Results</h1>
                        <h2 class="table-title">List of Assigned Lab Results</h2>
                        <table id="Table" class="table table-hover">
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
                                            <a href="{{ route('admin.labResultDownload', $labResult->id) }}" class="btn btn-primary btn-sm">Download</a>
                                            <form action="{{ route('admin.deleteLabResult', $labResult->id) }}" method="POST" style="display:inline;">
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
            <!-- Updated links for other patient-related actions -->
            <a class="record-btn btn-primary" role="button" href="{{ route('admin.users.patient_profile', $patient->id) }}">Patient Profile</a>
            <a class="record-btn btn-primary" role="button" href="{{ route('admin.users.patient_measurements', $patient->id) }}">Measurements</a>
            <a class="record-btn btn-primary" role="button" href="{{ route('admin.users.patient_documents', $patient->id) }}">Documents</a>
            <a class="record-btn btn-primary" role="button" href="{{ route('admin.users.patient_labResults', $patient->id) }}">Lab Results</a>
        </div>
    </div>

    <!-- Modal for Uploading Lab Result -->
    <div class="modal fade" id="uploadLabResultModal" tabindex="-1" aria-labelledby="uploadLabResultModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadLabResultModalLabel">Upload New Lab Result</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.uploadLabResult', $patient->id) }}" method="POST" enctype="multipart/form-data">
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

<!-- Existing Styling Maintained -->
<style>
    .main-content{
        margin-top:2rem;
        display:flex;
        justify-content:center;
        width:100%;
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
        width:13.375rem;
        height:17rem;
        display:flex;
        flex-direction:column;
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
