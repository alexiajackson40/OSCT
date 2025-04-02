<!DOCTYPE html>
<html lang="en">
<!-- Patient Schedule Page -->
<body>
    @include('layouts.header_patient') <!-- Include the header blade -->

    <div class="main-content">
        <div class="schedule-container mt-5">
            <div class="card">
                <div class="card-body d-flex flex-column">
                    <div class="schedule-content">
                        <h1 class="card-title">Programación vista a Planteles Escolares</h1>
                        <h2 class="table-title">Operación Salud Colima Tamizaje</h2>
                        <table id="Table" class="table">
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Ubicación</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($schedules as $schedule)
                                    <tr>
                                        <td>{{ $schedule->date }}</td>
                                        <td>{{ $schedule->location }}</td>
                                        <td>
                                            <!-- Actions (e.g. View details) -->
                                            <a href="{{ route('schedule.details', $schedule->id) }}" class="btn btn-primary">Ver Detalles</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footer') <!-- Optional footer -->
</body>

<style>
    .main-content {
        display: flex;
        justify-content: center;
        width: 100%;
        align-items: center;
        min-height: 100vh;
    }
    .schedule-container {
        width: 80%;
    }
    .card {
        background-color: #F2F2F2;
        height: 100%;
        min-height: 100vh;
    }
    .schedule-content {
        margin-left: 1.563rem;
        margin-right: 1.563rem;
    }
    .card-title {
        font-size: 2rem;
        font-weight: 500;
        text-align: left;
        margin-bottom: 1.125rem;
        margin-top: 1.563rem;
    }
    .table-title {
        font-size: 1.25rem;
        margin-bottom: 1.563rem;
    }
    .table {
        margin-bottom: 0px;
        --bs-table-bg: #F2F2F2;
        --bs-table-border-color: #000;
        align-items: center;
        text-align: center;
    }
    .tHead {
        font-size: 0.938rem;
    }
    .tBody {
        font-size: 0.75rem;
    }
</style>
</html>
