<!DOCTYPE html>
<html lang="en">
<!-- Patient Lab Results Page -->
<head>
     <!-- Import Bootstrap and Custom Styles -->
     <link href="{{ asset('theme.css') }}" rel="stylesheet">
     <link href="{{ asset('style.css') }}" rel="stylesheet">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
</head>
<body>
    @include('patient_user.header_patient')
    <div class="main-content">
        <div class="labresults-container mt-5">
            <div class="card">
                <div class="card-body d-flex flex-column">
                    <h1 class="card-title">Lab Results</h1>
                    <h2 class="table-title">List of Available Lab Reports</h2>
                    <div class="document-content mt-4">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Report Name</th>
                                    <th>Uploaded On</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($labResults as $result)
                                    <tr>
                                        <td>{{ $result->name }}</td>
                                        <td>{{ $result->created_at->format('Y-m-d') }}</td>
                                        <td>
                                            <a href="{{ route('parent.labResults.download', $result->id) }}" class="btn btn-sm btn-download btn-primary">Download</a>
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
    /* Styling for Containers*/
    .main-content {
        display: flex;
        justify-content: center;
        width: 100%;
        min-height: 100vh;
        background-color: var(--light-surface-one);
    }
    .labresults-container {
        width: 70%;
    }
    .card {
        background-color: #FAFAFA;
        height: 100%;
        min-height: 100vh;
        padding: 1.5rem;
    }
    /*-----------------------------------*/
    /* Styling Title*/
    .card-title {
        font-size: 2rem;
        font-weight: 500;
    }
    .table-title {
        font-size: 1.25rem;
        margin-bottom: 1rem;
    }
    /*-----------------------------------*/
    /* Styling for Table*/
    .table {
        align-items: center;
        margin-bottom: 0rem;
        --bs-table-bg: #FAFAFA;
        --bs-table-border-color: #000;
        border: 0.063rem solid #000000;
    }
    /*-----------------------------------*/
    /* Styling for Download Button*/
    .btn-download {
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
