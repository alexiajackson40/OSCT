<!DOCTYPE html>
<html lang="en">
<!-- Patient Documents Page-->
<body>
    <div id="header"></div> 
    <div class="main-content">
        <div class="document-container mt-5">
            <div class="card">
                <div class="card-body d-flex flex-column">
                    <div class="document-content">
                        <h1 class="card-title">Documents</h1>
                        <h2 class="table-title">List of Available Documents</h2>
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
    </div>
</body>

<style>
    .main-content {
        display: flex;
        justify-content: center;
        width: 100%;
        align-items: center;
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
        margin-left: 1.563rem;
        margin-right: 1.563rem;
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
</style>
</html>
