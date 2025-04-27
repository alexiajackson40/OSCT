<!DOCTYPE html>
<html lang="es">
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
                    <a id="back-btn" class="btn-back" href="{{ route('admin.patientUsers') }}">&lt; Regresar</a>
                    <button class="btn-edit" data-bs-toggle="modal" data-bs-target="#uploadLabResultModal">[Subir Resultado de Laboratorio]</button>
                </div>
                <div class="card-body d-flex flex-column">
                    <div class="document-content">
                        <h1 class="card-title">Resultados de Laboratorio de:<br> {{ $patient->PACIENTE }}</h1>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Nombre del Resultado</th>
                                    <th>Fecha Asignada</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($labResults as $labResult)
                                    <tr>
                                        <td>{{ $labResult->name }}</td>
                                        <td>{{ $labResult->date_assigned }}</td>
                                        <td>
                                            <a href="{{ route('admin.labResultDownload', $labResult->id) }}" class="btn btn-primary btn-download btn-sm" target="_blank">Descargar</a>
                                            <form action="{{ route('admin.deleteLabResult', $labResult->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
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
            <a class="record-btn btn-primary" role="button" href="{{ route('admin.users.patient_profile', $patient->CURP) }}">Perfil del Paciente</a>
            <a class="record-btn btn-primary" role="button" href="{{ route('admin.users.patient_measurements', $patient->CURP) }}">Mediciones</a>
            <a class="record-btn btn-primary" role="button" href="{{ route('admin.users.patient_documents', $patient->CURP) }}">Documentos</a>
            <a class="record-btn btn-primary active-btn" role="button" href="{{ route('admin.users.patient_labResults', $patient->CURP) }}">Resultados de Laboratorio</a>
        </div>
    </div>
    <!-- Modal for Uploading Lab Result -->
    <div class="modal fade" id="uploadLabResultModal" tabindex="-1" aria-labelledby="uploadLabResultModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadLabResultModalLabel">Subir Nuevo Resultado de Laboratorio</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.uploadLabResult', $patient->CURP) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="lab_result">Seleccionar Archivo</label>
                            <input type="file" name="lab_result" id="lab_result" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="name">Nombre del Resultado</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Subir</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
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
            justify-content: center;
        }
        /*-----------------------------------*/
        /* Styling for Back and Edit Buttons*/
        .btn-back {
            position: absolute;
            left: 1.875rem;
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
            right: 1.875rem;
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
        .top-buttons {
            margin-top: 0.625rem;
            margin-bottom: 0.625rem;
            width: 28.063rem;
            padding-top: 0.625rem;
            display: flex;
            flex-direction: row;
        }
        /*-----------------------------------*/
        /* Styling Title*/
        .card-title {
            font-size: 2rem;
            font-weight: 500;
            text-align: left;
            margin-bottom: 1.5625rem;
            margin-top: 2.5rem;
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
            width: 13.375rem;
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
            border-radius:0.5rem;
            font-weight: 500;
            justify-content: center;
        }
        .btn-danger {
            height: 3rem;
            display: flex;
            align-items: center;
            border-radius:0.5rem;
            font-weight: 500;
            justify-content: center;
        }
        /*-----------------------------------*/
    </style>
</body>
</html>
