<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documents - Operación Salud Colima Tamizaje</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <!-- Placeholder for the header -->
    @include('layouts.header_patient')

    <!-- Main Content -->
    <div class="main-content">
        <div class="document-container mt-5">
            <div class="card">
                <div class="card-body d-flex flex-column">
                    <div class="document-content">
                        <h1 class="card-title">Documents</h1>
                        <div id="documentsTable"></div>
                        <h2 class="table-title">Example Schedule Display Filler</h2>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Document Name</th>
                                    <th>Date Assigned</th>
                                    <th>Download Link</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><a href="#" class="btn btn-link">Document 1</a></td>
                                    <td>March 17th, 2025</td>
                                    <td><a href="#" class="btn btn-link">Download</a></td>
                                </tr>
                                <tr>
                                    <td><a href="#" class="btn btn-link">Document 2</a></td>
                                    <td>April 17th, 2025</td>
                                    <td><a href="#" class="btn btn-link">Download</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/loadHeader.js') }}"></script>
    <script type="module">
        import { loadTable } from '{{ asset('js/loadTable.js') }}'
        const page = 'documents'
        loadTable(page)
    </script>
    <script type="module" src="{{ asset('js/main.js') }}"></script>
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
        margin-left: 25px;
        margin-right: 25px;
    }
    .card-title {
        font-size: 32px;
        font-weight: 500;
        text-align: left;
        margin-bottom: 25px;
        margin-top: 25px;
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
    .table-title {
        font-size: 20px;
        margin-bottom: 20px;
    }
</style>

</html>
