<!DOCTYPE html>
<html lang="en">
<!-- Patient User Measurements Page -->
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
    <div class="container mt-5">
        <div class="card">
            <div class="top-button">
                <a href="{{ route('patient.profile') }}" class="btn-back">&lt; Volver al perfil</a>
            </div>
            <div class="card-body d-flex flex-column">
                <h2 class="card-title">Mediciones registradas</h2>
                <div class="measurements-content mt-4">
                    @if($measurements->isEmpty())
                    <p>No hay medidas disponibles.</p>
                    @else
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Cintura</th>
                                <th>Cadera</th>
                                <th>Relación cintura-cadera</th>
                                <th>Masa corporal</th>
                                <th>Colesterol</th>
                                <th>Glucosa</th>
                                <th>Hemoglobina</th>
                                <th>Triglicéridos</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($measurements as $m)
                                <tr>
                                    <td>{{ $m->created_at->format('Y-m-d') }}</td>
                                    <td>{{ $m->waist ?? '—' }}</td>
                                    <td>{{ $m->hip ?? '—' }}</td>
                                    <td>{{ $m->waist_hip_ratio ?? '—' }}</td>
                                    <td>{{ $m->body_mass ?? '—' }}</td>
                                    <td>{{ $m->cholesterol ?? '—' }}</td>
                                    <td>{{ $m->glucose_level ?? '—' }}</td>
                                    <td>{{ $m->hemoglobin ?? '—' }}</td>
                                    <td>{{ $m->triglycerides ?? '—' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
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
    .container {
        width: fit-content;
    }
    .card {
        background-color: #FAFAFA;
        height: 100%;
        min-height: 100vh;
        display: flex;
        justify-content: center;
    }
    .card-body {
        padding: 2rem 3rem 3rem 3rem;
    }
    /*-----------------------------------*/
    /* Styling Title*/
    .card-title {
        font-size: 2rem;
        font-weight: 500;
        text-align: left;
    }
    /*-----------------------------------*/
    /* Styling for Table*/
    .table {
        table-layout: fixed;
        align-items: center;
        margin-bottom: 0rem;
        --bs-table-bg: white;
        --bs-table-border-color: #000;
    }
    /*-----------------------------------*/
    /* Styling for Back Button*/
    .top-button {
        padding: 1.5rem 1.5rem 0rem 1.5rem;
        display: flex;
        align-items: left;
    }
    .btn-back {
        font-size: 1.25rem;
        font-weight: 500;
        border: none;
        color: #000;
        background: #FAFAFA;
        border-radius: 1rem;
        text-decoration: none;
    }
    .btn-back:hover {
        background-color: #E0E0E0;
    }
    /*-----------------------------------*/
</style>
</html>