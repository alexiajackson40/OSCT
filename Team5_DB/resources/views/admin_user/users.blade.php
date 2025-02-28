<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users - Operación Salud Colima Tamizaje</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <!-- Placeholder for the header -->
    @include('layouts.header_admin')

    <!-- Main Content -->
    <div class="main-content">
        <div class="users-container mt-5">
            <div class="card">
                <div class="card-body d-flex flex-column">
                    <div class="document-content">
                        <h1 class="card-title">Users:Admin</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/loadHeader.js') }}"></script>
    <script type="module" src="{{ asset('js/main.js') }}"></script>
</body>

<style>
    .main-content {
        display:flex;
        justify-content:center;
        width: 100%;
        align-items:center;
        min-height: 100vh;
    }
    .users-container {
        width: 70%;
    }
    .card {
        background-color:#F2F2F2;
        height: 100%;
        min-height: 100vh;
    }
    .document-content {
        margin-left:25px;
        margin-right:25px;
    }
    .card-title {
        font-size:32px;
        font-weight: 500;
        text-align:left;
        margin-bottom:25px;
        margin-top:25px;
    }
</style>

</html>
