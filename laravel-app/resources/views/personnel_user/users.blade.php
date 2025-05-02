<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Import Bootstrap and Custom Styles -->
    <link href="{{ asset('theme.css') }}" rel="stylesheet">
    <link href="{{ asset('style.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
</head>
<body>
    @include('personnel_user.header_personnel')
    <div class="main-content d-flex justify-content-center">
        <div class="users-container mt-5">
            <div class="card">
                <div class="card-body">
                    <h1 class="card-title mb-4">Alumnos</h1>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Número de identificación</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($patients as $patient)
                                <tr>
                                    <td>{{ $patient->PACIENTE }}</td>
                                    <td>{{ $patient->getKey() }}</td>
                                    <td>
                                        <a href="{{ route('personnel.patientProfile', $patient->getKey()) }}" class="btn btn-primary btn-view btn-sm">Ver Perfil</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
<style>
    /* Styling for Containers*/
    .main-content {
        width: 100%;
        min-height: 100vh;
        background-color: var(--light-surface-one);
    }
    .users-container {
        width: 70%;
    }
    .card {
        background-color: #FAFAFA;
        height: 100%;
        min-height: 100vh;
        display: flex;
    }
    .card-body {
        margin-left: 1.5625rem;
        margin-right: 1.5625rem;
    }
    /*-----------------------------------*/
    /* Styling Title*/
    .card-title {
        font-size: 2.2rem;
        font-weight: 500;
        text-align: left;
        margin-bottom: 1.5625rem;
        margin-top: 2rem;
    }
    /*-----------------------------------*/
    /* Styling for Table*/
    .table {
        align-items: center;
        margin-bottom: 0rem;
        --bs-table-bg: white;
        --bs-table-border-color: #000;
        border: 0.063rem solid #000000;
    }
    /*-----------------------------------*/
    /* Styling for View Button*/
    .btn-view {
        height: 3rem;
        display: flex;
        align-items: center;
        border-radius: 0.5rem;
        font-weight: 500;
        justify-content: center;
    }
    /*-----------------------------------*/
</style>
</html>
