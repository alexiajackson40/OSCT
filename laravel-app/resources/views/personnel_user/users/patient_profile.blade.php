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
        <div class="profile-container mt-5">
            <div class="card">
                <!-- Top Buttons -->
                <div class="top-buttons d-flex flex-row align-self-center">
                    <a href="{{ route('personnel.users') }}" class="btn-back">&lt; Volver</a>
                    <button class="btn-edit" data-bs-toggle="modal" data-bs-target="#editPatientModal">[Editar Información]</button>
                </div>
                <!-- Patient Information -->
                <div class="card-body d-flex flex-column">
                    <h1 class="card-title">{{ $patient->PACIENTE }}</h1>
                    <div class="information-container d-flex flex-column align-items-left">
                        <h2 class="container-header">Información del Paciente</h2>
                        <table class="table">
                            <tr>
                                <td><strong>Número de identificación:</strong></td>
                                <td>{{ $patient->No_SOL }}</td>
                            </tr>
                            <tr>
                                <td><strong>Sexo:</strong></td>
                                <td>{{ $patient->SEXO }}</td>
                            </tr>
                            <tr>
                                <td><strong>Edad:</strong></td>
                                <td>{{ $patient->EDAD }}</td>
                            </tr>
                            <tr>
                                <td><strong>Escuela:</strong></td>
                                <td>{{ $patient->ESCUELA }}</td>
                            </tr>
                            <tr>
                                <td><strong>CURP:</strong></td>
                                <td>{{ $patient->CURP }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Navigation Buttons -->
        <div class="button-container mt-5 d-flex flex-column">
            <a class="record-btn btn-primary active-btn" role="button" href="{{ route('personnel.patientProfile', $patient->CURP) }}">Perfil del Paciente</a>
            <a class="record-btn btn-primary" role="button" href="{{ route('personnel.patientMeasurements', $patient->CURP) }}">Medidas</a>
            <a class="record-btn btn-primary" role="button" href="{{ route('personnel.documents', $patient->CURP) }}">Documentos</a>
            <a class="record-btn btn-primary" role="button" href="{{ route('personnel.patientLabResults', $patient->CURP) }}">Resultados de Laboratorio</a>
        </div>
    </div>
    <!-- Edit Patient Modal -->
    <div class="modal fade" id="editPatientModal" tabindex="-1" aria-labelledby="editPatientModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar la Información del Paciente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('personnel.updatePatient', $patient->CURP) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="first_name">Nombre Completo</label>
                            <input type="text" name="first_name" class="form-control" value="{{ $patient->PACIENTE }}" required>
                        </div>
                        <div class="form-group">
                            <label for="school_name">Escuela</label>
                            <input type="text" name="school_name" class="form-control" value="{{ $patient->ESCUELA }}" required>
                        </div>
                        <div class="form-group">
                            <label for="gender">Género</label>
                            <input type="text" name="gender" class="form-control" value="{{ $patient->SEXO }}" required>
                        </div>
                        <div class="form-group">
                            <label for="age">Edad</label>
                            <input type="number" name="age" class="form-control" value="{{ $patient->EDAD }}" required>
                        </div>
                        <div class="form-group">
                            <label for="fasting_status">Estado de Ayuno</label>
                            <input type="text" name="fasting_status" class="form-control" value="{{ $patient->AYUNO }}">
                        </div>
                        <div class="form-group">
                            <label for="glucose">Glucosa</label>
                            <input type="text" name="glucose" class="form-control" value="{{ $patient->GLUCOSA }}">
                        </div>
                        <div class="form-group">
                            <label for="triglycerides">Triglicéridos</label>
                            <input type="text" name="triglycerides" class="form-control" value="{{ $patient->TRIGLICÉRIDOS }}">
                        </div>
                        <div class="form-group">
                            <label for="total_cholesterol">Cholesterol Total</label>
                            <input type="text" name="total_cholesterol" class="form-control" value="{{ $patient->{'COLESTEROL TOTAL'} }}">
                        </div>
                        <div class="form-group">
                            <label for="hba1c">HBA1C</label>
                            <input type="text" name="hba1c" class="form-control" value="{{ $patient->HBA1C }}">
                        </div>
                        <div class="form-group">
                            <label for="weight">Peso</label>
                            <input type="text" name="weight" class="form-control" value="{{ $patient->PESO }}">
                        </div>
                        <div class="form-group">
                            <label for="height">Altura</label>
                            <input type="text" name="height" class="form-control" value="{{ $patient->TALLA }}">
                        </div>
                        <div class="form-group">
                            <label for="bmi">BMI</label>
                            <input type="text" name="bmi" class="form-control" value="{{ $patient->IMC }}">
                        </div>
                        <div class="form-group">
                            <label for="icc">ICC</label>
                            <input type="text" name="icc" class="form-control" value="{{ $patient->ICC }}">
                        </div>
                        <div class="form-group">
                            <label for="waist">Cintura</label>
                            <input type="text" name="waist" class="form-control" value="{{ $patient->CINTURA }}">
                        </div>
                        <div class="form-group">
                            <label for="hip">Cadera</label>
                            <input type="text" name="hip" class="form-control" value="{{ $patient->CADERA }}">
                        </div>
                        <div class="form-group">
                            <label for="comments">Comentarios</label>
                            <textarea name="comments" class="form-control">{{ $patient->COMENTARIO }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
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
        border: none;
        color: #000;
        background: #FAFAFA;
        font-size: 1.25rem;
        font-weight: 500;
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
        width: 28.063rem;
    }
    /*-----------------------------------*/
    /* Styling for Table*/
    .container-header {
        font-size: 1.25rem;
        font-weight: 500;
        padding: 0.9rem 0rem 0rem 0.9rem;
    }
    .information-container {
        margin-top: 0.75rem;
        width: 28rem;
        height: auto;
        border-radius: 0.375rem;
        border: 0.063rem solid rgba(0,0,0,0.30);
        background: #FFF;
    }
    /*Contact Container needs to go here */
    .table {
        margin-left: 0.9rem;
        color: #000;
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
