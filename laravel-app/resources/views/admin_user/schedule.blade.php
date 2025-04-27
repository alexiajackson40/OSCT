<!DOCTYPE html>
<html lang="es">
<head>
    <link href="{{ asset('theme.css') }}" rel="stylesheet">
    <link href="{{ asset('style.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="{{ asset('bootstrap.min.js') }}" defer></script>
    <script src="{{ asset('loadContent.js') }}" defer></script>
</head>
<body>
    @include('admin_user.header_admin')
    <div class="main-content">
        <div class="schedule-container mt-5">
            <div class="card">
                <form action="{{ route('admin.uploadSchedule') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body d-flex flex-column">
                        <h1 class="card-title">Programación de Visitas a Planteles Escolares</h1>
                        <h2 class="table-title">Operación Salud Colima Tamizaje</h2>
                        <div class="form-group upload-form">
                            <label for="schedule_file">Subir Horario (.CSV solamente)</label>
                            <input type="file" class="form-control" id="schedule_file" name="schedule_file" accept=".csv" required>
                            <button type="submit" class="btn btn-primary btn-upload mt-3">Subir Horario</button>
                        </div>
                    <div class="schedule-content mt-4">
                        <table class="table table-striped table-bordered">
                            <thead class="tHead">
                                <tr>
                                    <th>NIVEL</th>
                                    <th>TURNO</th>
                                    <th>CCT</th>
                                    <th>NOMBRE DE LA ESCUELA</th>
                                    <th>MUNICIPIO</th>
                                    <th>LOCALIDAD</th>
                                    <th>DOMICILIO</th>
                                    <th>TOTAL DE ALUMNOS</th>
                                    <th>FECHA</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="tBody">
                                @foreach($schedules as $schedule)
                                    <tr>
                                        <td>{{ $schedule->level }}</td>
                                        <td>{{ $schedule->shift }}</td>
                                        <td>{{ $schedule->cct }}</td>
                                        <td>{{ $schedule->school_name }}</td>
                                        <td>{{ $schedule->municipality }}</td>
                                        <td>{{ $schedule->locality }}</td>
                                        <td>{{ $schedule->address }}</td>
                                        <td>{{ $schedule->total_students }}</td>
                                        <td>{{ $schedule->date }}</td>
                                        <td>
                                            <a href="{{ route('schedule.edit', $schedule->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
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
    .schedule-container {
        width: 95%;
    }
    .card {
        background-color: #FAFAFA;
        height: 100%;
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
    /* Styling Upload section*/
    .btn-upload {
        height: 3rem;
        display: flex;
        align-items: center;
        border-radius: 0.5rem;
        font-weight: 500;
        justify-content: center;
    }
    .upload-form {
        width: 25%;
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
    .tHead {
        font-weight: bold;
        font-size: 0.85rem;
    }
    .tBody {
        font-size: 0.85rem;
    }
    /*-----------------------------------*/
    /* Styling for Edit Button*/
    .btn-warning {
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
