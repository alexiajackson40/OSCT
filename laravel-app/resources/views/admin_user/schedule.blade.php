<!DOCTYPE html>
<html lang="en">
<head>
    <link href="{{ asset('theme.css') }}" rel="stylesheet">
    <link href="{{ asset('style.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
</head>
<body>
    @include('admin_user.header_admin')

    <div class="main-content">
        <div class="schedule-container mt-5">
            <div class="card">
            <form action="{{ route('admin.uploadSchedule') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body d-flex flex-column">
                <h1 class="card-title">Programación vista a Planteles Escolares</h1>
                <h2 class="table-title">Operación Salud Colima Tamizaje</h2>
                <div class="form-group">
                    <label for="schedule_file">Upload Schedule (.CSV only)</label>
                    <input type="file" class="form-control" id="schedule_file" name="schedule_file" accept=".csv" required>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Upload Schedule</button>
                </div>
                </form>
                <div class="schedule-content mt-4">
                    <table class="table table-bordered">
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
                            </tr>
                        </thead>
                        <tbody class="tBody">
                            @foreach($schedules as $schedule)
                                <tr>
                                    <td>{{ $schedule->NIVEL }}</td>
                                    <td>{{ $schedule->TURNO }}</td>
                                    <td>{{ $schedule->CCT }}</td>
                                    <td>{{ $schedule->NOMBRE_DE_LA_ESCUELA }}</td>
                                    <td>{{ $schedule->MUNICIPIO }}</td>
                                    <td>{{ $schedule->LOCALIDAD }}</td>
                                    <td>{{ $schedule->DOMICILIO }}</td>
                                    <td>{{ $schedule->TOTAL_DE_ALUMNOS }}</td>
                                    <td>{{ $schedule->FECHA }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <style>
        .main-content {
            display: flex;
            justify-content: center;
            width: 100%;
            min-height: 100vh;
        }

        .schedule-container {
            width: 90%;
        }

        .card {
            background-color: #F2F2F2;
            height: 100%;
            padding: 1.5rem;
        }

        .card-title {
            font-size: 2rem;
            font-weight: 500;
        }

        .table-title {
            font-size: 1.25rem;
            margin-bottom: 1rem;
        }

        .table {
            background-color: white;
        }

        .tHead {
            font-weight: bold;
            font-size: 0.9rem;
        }

        .tBody {
            font-size: 0.85rem;
        }
    </style>

    <script src="{{ asset('js/loadContent.js') }}"></script>
    <script type="module" src="{{ asset('js/main.js') }}"></script>
</body>
</html>
