<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Import Bootstrap and Custom Styles -->
    <link href="{{ asset('theme.css') }}" rel="stylesheet">
    <link href="{{ asset('style.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
</head>
<!-- Patient Measurements Page -->
<body>
    @include('admin_user.header_admin')
    <div class="main-content">
        <div class="profile-container mt-5">
            <div class="card">
                <!-- Top Buttons -->
                <div class="top-buttons d-flex flex-row align-self-center">
                    <a href="{{ route('admin.patientUsers') }}" class="btn-back">&lt; Regresar</a>
                </div>

                <div class="card-body d-flex flex-column">
                    <h1 class="card-title">Mediciones de:<br> {{ $patient->PACIENTE }}</h1>
                    <!-- Form starts -->
                    <form action="{{ route('admin.updateMeasurement', $patient->CURP) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="measurements-container d-flex flex-column align-items-left">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Tipo de Medición</th>
                                        <th>Valor</th>
                                        <th>Fecha</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($measurements as $measurement)
                                        <tr>
                                            <td>Cintura</td>
                                            <td><input type="text" name="measurements[{{ $measurement->id }}][waist]" value="{{ $measurement->waist }}" class="form-control"></td>
                                            <td>{{ $measurement->created_at->format('Y-m-d') }}</td>
                                        </tr>
                                        <tr>
                                            <td>Cadera</td>
                                            <td><input type="text" name="measurements[{{ $measurement->id }}][hip]" value="{{ $measurement->hip }}" class="form-control"></td>
                                            <td>{{ $measurement->created_at->format('Y-m-d') }}</td>
                                        </tr>
                                        <tr>
                                            <td>Relación Cintura-Cadera</td>
                                            <td><input type="text" name="measurements[{{ $measurement->id }}][waist_hip_ratio]" value="{{ $measurement->waist_hip_ratio }}" class="form-control"></td>
                                            <td>{{ $measurement->created_at->format('Y-m-d') }}</td>
                                        </tr>
                                        <tr>
                                            <td>Masa Corporal</td>
                                            <td><input type="text" name="measurements[{{ $measurement->id }}][body_mass]" value="{{ $measurement->body_mass }}" class="form-control"></td>
                                            <td>{{ $measurement->created_at->format('Y-m-d') }}</td>
                                        </tr>
                                        <tr>
                                            <td>Colesterol</td>
                                            <td><input type="text" name="measurements[{{ $measurement->id }}][cholesterol]" value="{{ $measurement->cholesterol }}" class="form-control"></td>
                                            <td>{{ $measurement->created_at->format('Y-m-d') }}</td>
                                        </tr>
                                        <tr>
                                            <td>Nivel de Glucosa</td>
                                            <td><input type="text" name="measurements[{{ $measurement->id }}][glucose_level]" value="{{ $measurement->glucose_level }}" class="form-control"></td>
                                            <td>{{ $measurement->created_at->format('Y-m-d') }}</td>
                                        </tr>
                                        <tr>
                                            <td>Hemoglobina</td>
                                            <td><input type="text" name="measurements[{{ $measurement->id }}][hemoglobin]" value="{{ $measurement->hemoglobin }}" class="form-control"></td>
                                            <td>{{ $measurement->created_at->format('Y-m-d') }}</td>
                                        </tr>
                                        <tr>
                                            <td>Triglicéridos</td>
                                            <td><input type="text" name="measurements[{{ $measurement->id }}][triglycerides]" value="{{ $measurement->triglycerides }}" class="form-control"></td>
                                            <td>{{ $measurement->created_at->format('Y-m-d') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Guardar Cambios</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="button-container mt-5 d-flex flex-column">
            <a class="record-btn btn-primary" role="button" href="{{ route('admin.users.patient_profile', $patient->CURP) }}">Perfil del Paciente</a>
            <a class="record-btn btn-primary active-btn" role="button" href="{{ route('admin.users.patient_measurements', $patient->CURP) }}">Mediciones</a>
            <a class="record-btn btn-primary" role="button" href="{{ route('admin.users.patient_documents', $patient->CURP) }}">Documentos</a>
            <a class="record-btn btn-primary" role="button" href="{{ route('admin.users.patient_labResults', $patient->CURP) }}">Resultados de Laboratorio</a>
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
    .profile-container {
        width: fit-content;
    }
    .card {
        background-color: #FAFAFA;
        width: fit-content;
        height: fit-content;
        display: flex;
        justify-content: center;
    }
    .card-body {
        padding: 2.5rem;
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    /*-----------------------------------*/
    /* Styling for Back Button*/
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
    /*-----------------------------------*/
    /* Styling Title*/
    .card-title {
        font-size: 2rem;
        font-weight: 500;
        width: 40rem;
    }
    /*-----------------------------------*/
    /* Styling for Table*/
    .measurements-container {
        margin-top: 0.75rem;
        width: 40rem;
        height: auto;
        border-radius: 0.375rem;
        border: 0.063rem solid rgba(0, 0, 0, 0.30);
        background: #FFF;
        display: flex;
        justify-content: left;
        align-items: left;
    }
    .table {
        margin-left: 0.9rem;
        margin-right: 0.9rem;
        color: #000000;
        font-size: 1rem;
        font-weight: 400;
        width: auto;
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
</style>
</html>
