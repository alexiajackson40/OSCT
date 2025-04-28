<!DOCTYPE html>
<html lang="es">
<head>
    <link href="{{ asset('theme.css') }}" rel="stylesheet">
    <link href="{{ asset('style.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
</head>
<body>
    @include('personnel_user.header_personnel')
    <div class="main-content">
        <div class="card mt-5">
            <div class="card-body">
                <h1 class="card-title">Editar Entrada de Horario</h1>
                <form action="{{ route('personnel.schedule.update', $schedule->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Nivel</label>
                            <input type="text" class="form-control" name="level" value="{{ $schedule->level }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Turno</label>
                            <input type="text" class="form-control" name="shift" value="{{ $schedule->shift }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>CCT</label>
                            <input type="text" class="form-control" name="cct" value="{{ $schedule->cct }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Nombre de la Escuela</label>
                            <input type="text" class="form-control" name="school_name" value="{{ $schedule->school_name }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Municipio</label>
                            <input type="text" class="form-control" name="municipality" value="{{ $schedule->municipality }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Localidad</label>
                            <input type="text" class="form-control" name="locality" value="{{ $schedule->locality }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Domicilio</label>
                            <input type="text" class="form-control" name="address" value="{{ $schedule->address }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Total de Alumnos</label>
                            <input type="number" class="form-control" name="total_students" value="{{ $schedule->total_students }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Fecha</label>
                            <input type="date" class="form-control" name="date" value="{{ $schedule->date }}" required>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('personnel.schedule') }}" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-primary">Actualizar Horario</button>
                    </div>
                </form>
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
        .card {
            width: 40%;
            height: fit-content;
            background-color: #FAFAFA;
        }
        .card-body {
            padding: 2rem;
        }
        /*-----------------------------------*/
        /* Styling Title*/
        .card-title {
            font-size: 2rem;
            font-weight: 500;
            margin-bottom: 1.5rem;
        }
        /*-----------------------------------*/
        /* Styling for Button*/
        .btn {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 3rem;
            border-radius:0.5rem;
            font-weight: 500;
        }
        /*-----------------------------------*/
    </style>
</body>
</html>
