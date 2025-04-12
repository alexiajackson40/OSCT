<!DOCTYPE html>
<html lang="en">
<!-- Personnel User Documents Page -->
<body>
    @include('layouts.header_personnel') <!-- Include the header blade -->

    <div class="main-content">
        <div class="document-container mt-5">
            <div class="card">
                <div class="top-buttons d-flex flex-row align-self-center">
                    <button class="btn-back" href="{{ route('admin.users.personnelUsers') }}">&lt; Go Back</button>
                    <button class="btn-edit">[Upload Document]</button>
                </div>
                <div class="card-body d-flex flex-column">
                    <div class="document-content">
                        <h1 class="card-title">Documents</h1>
                        <h2 class="table-title">List of Assigned Documents</h2>
                        <table id="Table" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Document Name</th>
                                    <th>Uploaded On</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($documents as $document)
                                    <tr>
                                        <td>{{ $document->name }}</td>
                                        <td>{{ $document->created_at->format('Y-m-d') }}</td>
                                        <td>
                                            <!-- Link to view or download the document -->
                                             <!-- throwing error since route does not exist -->
                                            <a href="{{ route('admin.users.patientDocuments.download', $document->id) }}" class="btn btn-primary">Download</a> 
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
            <a class="record-btn btn-primary" role="button" href="{{ route('admin.users.patientProfile', $patient->id) }}">Patient Profile</a>
            <a class="record-btn btn-primary" role="button" href="{{ route('admin.users.patientMeasurements', $patient->id) }}">Measurements</a>
            <a class="record-btn btn-primary" role="button" href="{{ route('admin.users.patientDocuments', $patient->id) }}">Documents</a>
            <a class="record-btn btn-primary" role="button" href="{{ route('admin.users.patientLabResults', $patient->id) }}">Lab Results</a>
        </div>
    </div>
</body>

<style>
    .main-content {
        margin-top: 2rem;
        display: flex;
        justify-content: center;
        width: 100%;
        min-height: 100vh;
    }
    .document-container {
        width: 70%;
    }
    .card {
        background-color: #F2F2F2;
        height: 100%;
        min-height: 100vh;
    }
    .document-content {
        margin-left: 1.5625rem;
        margin-right: 1.5625rem;
    }
    .card-title {
        font-size: 2rem;
        font-weight: 500;
        text-align: left;
        margin-bottom: 1.125rem;
        margin-top: 1.563rem;
    }
    .table-title {
        font-size: 1.25rem;
        margin-bottom: 1.563rem;
    }
    .table {
        margin-bottom: 0px;
        --bs-table-bg: #F2F2F2;
        --bs-table-border-color: #000;
        align-items: center;
    }
    .td a {
        display: flex;
        align-items: center;
        justify-content: center;
        color: #000;
    }
    .button-container {
        width: 13.375rem;
        height: 17rem;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
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
    .top-buttons {
        margin-top: 0.625rem;
        margin-bottom: 0.625rem;
        width: 28.063;
        padding-top: 0.625rem;
        display: flex;
        flex-direction: row;
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
        border: none;
        color: #000;
        background: #F2F2F2;
        font-size: 1.25rem;
        font-weight: 500;
    }
</style>
</html>
