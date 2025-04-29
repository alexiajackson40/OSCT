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
    <div class="main-content">
        <div class="document-container mt-5">
            <div class="card">
                <div class="top-buttons d-flex flex-row align-self-center">
                    <a id="back-btn" class="btn-back" href="{{ route('personnel.users') }}">&lt; Volver</a>
                    <button class="btn-edit" data-bs-toggle="modal" data-bs-target="#uploadLabResultModal">[Cargar Resultados de Laboratorio]</button>
                </div>
                <div class="card-body d-flex flex-column">
                    <h1 class="card-title">Resultados de Laboratorio para:<br> {{ $patient->PACIENTE }}</h1>
                    <div class="document-content">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Nombre del Resultado del Laboratorio</th>
                                    <th>Fecha de Carga</th>
                                    <th>Comportamiento</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($labResults as $labResult)
                                    <tr>
                                        <td>{{ $labResult->name }}</td>
                                        <td>{{ $labResult->date_assigned }}</td>
                                        <td>
                                            <a href="{{ url('/' . $labResult->file_path) }}" target="_blank" class="btn btn-primary btn-download btn-sm">Descargar</a>
                                            <form action="{{ route('personnel.deleteLabResult', $labResult->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Borrar</button>
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
            <a class="record-btn btn-primary" role="button" href="{{ route('personnel.patientProfile', $patient->CURP) }}">Perfil del Paciente</a>
            <a class="record-btn btn-primary" role="button" href="{{ route('personnel.patientMeasurements', $patient->CURP) }}">Medidas</a>
            <a class="record-btn btn-primary" role="button" href="{{ route('personnel.documents', $patient->CURP) }}">Documentos</a>
            <a class="record-btn btn-primary active-btn" role="button" href="{{ route('personnel.patientLabResults', $patient->CURP) }}">Resultados de Laboratorio</a>
        </div>
    </div>
    <!-- Upload Lab Result Modal -->
    <div class="modal fade" id="uploadLabResultModal" tabindex="-1" aria-labelledby="uploadLabResultModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadLabResultModalLabel">Cargar Nuevo Resultado de Laboratorio</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('personnel.uploadLabResult', $patient->CURP) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="lab_result">Seleccionar Resultado de Laboratorio (PDF Solo)</label>
                            <input type="file" name="lab_result" id="lab_result" accept="application/pdf" class="form-control" required>
                        </div>
                        <div class="form-group mt-3">
                            <label for="name">Nombre del Resultado del Laboratorio</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Subir</button>
                    </form>
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
    .document-container {
        width: 70%;
    }
    .card {
        background-color: #FAFAFA;
        height: 100%;
        min-height: 100vh;
        display: flex;
    }
    /*-----------------------------------*/
    /* Styling for Back and Edit Buttons*/
    .top-buttons {
        margin-top: 0.6rem;
        margin-bottom: 0.6rem;
        width: 28rem;
        padding-top: 0.6rem;
        display: flex;
        flex-direction: row;
    }
    .btn-back {
        position: absolute;
        left: 1.9rem;
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
    .btn-edit {
        position: absolute;
        right: 1.9rem;
        font-size: 1.25rem;
        font-weight: 500;
        border: none;
        color: #000;
        background: #FAFAFA;
        border-radius: 1rem;
    }
    .btn-edit:hover {
        background-color: #E0E0E0;
    }
    /*-----------------------------------*/
    /* Styling Title*/
    .card-title {
        font-size: 2rem;
        font-weight: 500;
        text-align: left;
        margin-top: 2.5rem;
        margin-bottom: 1.5625rem;
        margin-left: 1.5625rem;
        margin-right: 1.5625rem;
    }
    /*-----------------------------------*/
    /* Styling for Table*/
    .document-content {
        margin-left: 1.5625rem;
        margin-right: 1.5625rem;
    }
    .table {
        align-items: center;
        margin-bottom: 0rem;
        --bs-table-bg: #FAFAFA;
        --bs-table-border-color: #000;
        border: 0.063rem solid #000000;
    }
    /*-----------------------------------*/
    /* Styling for Side Buttons*/
    .button-container {
        width: 13rem;
        height: fit-content;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-right: 0.5rem;
        margin-left: 0.5rem;
        gap: 0.5rem;
    }
    .record-btn {
        width: 100%;
        height: 3.75rem;
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
        border-radius: 0.5rem;
        background: #7C1332;
        box-shadow: 0rem 0.25rem 0.25rem 0rem rgba(0, 0, 0, 0.25);
        color: #FFF;
        font-size: 1.25rem;
        font-weight: 500;
        text-decoration: none;
    }
    .record-btn:hover {
        background-color: #52051C;
    }
    .active-btn {
        background: #808080;
        box-shadow: 0rem 0.25rem 0.25rem 0rem rgba(0, 0, 0, 0.25) inset;
    }
    /*-----------------------------------*/
    /* Styling for Download and Delete Buttons*/
    .btn-download {
        height: 3rem;
        display: flex;
        align-items: center;
        border-radius: 0.5rem;
        font-weight: 500;
        justify-content: center;
    }
    .btn-danger {
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
