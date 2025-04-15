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

    <div class="main-content mt-5 d-flex justify-content-center">
        <div class="schedule-container w-100 px-4">
            <div class="card">
                <button class="btn-page btn-primary">[Update Schedule]</button>
                <div class="card-body d-flex flex-column">
                    <h1 class="card-title">Programación vista a Planteles Escolares</h1>
                    <h2 class="table-title">Operación Salud Colima Tamizaje</h2>

                    <table class="table table-bordered">
                        <thead class="tHead">
                            <tr>
                                <th>Plantel</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="tBody">
                            @foreach($schedules as $schedule)
                                <tr>
                                    <td>{{ $schedule->school }}</td>
                                    <td>{{ \Carbon\Carbon::parse($schedule->date)->format('Y-m-d') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($schedule->time)->format('H:i') }}</td>
                                    <td>
                                        <a href="{{ route('admin.users.editSchedule', $schedule->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

    @include('layouts.footer')
</body>

<style>
    .main-content {
        display: flex;
        justify-content: center;
        width: 100%;
        min-height: 100vh;
    }
    .card {
        background-color: #F2F2F2;
        min-height: 100vh;
        padding: 1rem;
    }
    .card-title {
        font-size: 2rem;
        font-weight: 600;
        text-align: left;
        margin-bottom: 1rem;
    }
    .table-title {
        font-size: 1.25rem;
        margin-bottom: 1rem;
    }
    .table {
        background-color: #F2F2F2;
        color: #000;
    }
    .btn-page {
        position: absolute;
        right: 1rem;
        top: 1rem;
        width: auto;
        border: none;
        background: #F2F2F2;
        font-size: 1rem;
        font-weight: 500;
    }
    .tHead {
        font-size: 1rem;
        font-weight: 600;
    }
    .tBody {
        font-size: 0.9rem;
    }
</style>
</html>
