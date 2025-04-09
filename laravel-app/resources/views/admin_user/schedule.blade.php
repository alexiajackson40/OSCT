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
    <!-- Include the header -->
    @include('admin_user.header_admin')
    <div class="main-content">
        <div class="schedule-container mt-5">
            <div class="card">
                <!-- Button for uploading schedule -->
                <form action="{{ route('admin.uploadSchedule') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body d-flex flex-column">
                        <h1 class="card-title">Programación vista a Planteles Escolares</h1>
                        <h2 class="table-title">Operación Salud Colima Tamizaje</h2>
                        <!-- Schedule Upload -->
                        <div class="form-group">
                            <label for="schedule_file">Upload Schedule (Image or PDF)</label>
                            <input type="file" class="form-control" id="schedule_file" name="schedule_file" accept="image/*, .pdf" required>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Upload Schedule</button>
                    </div>
                </form>
                <!-- Existing schedules table -->
                <div class="schedule-content">
                    <table class="table">
                        <thead class="tHead">
                            <tr>
                                <th>Fecha</th>
                                <th>Horario</th>
                                <th>Plantel</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody class="tBody">
                            @foreach($schedules as $schedule)
                                <tr>
                                    <td>{{ $schedule->date }}</td>
                                    <td>{{ $schedule->time }}</td>
                                    <td>{{ $schedule->school }}</td>
                                    <td>
                                        <!-- Link to download the schedule file -->
                                        <a href="{{ Storage::url('schedules/'.$schedule->file_name) }}" class="btn btn-primary">Download</a>
                                    </td>
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
            display:flex;
            justify-content:center;
            width:100%;
            align-items:center;
            min-height:100vh;
        }
        .schedule-container {
            width:80%;
        }
        .card {
            background-color:#F2F2F2;
            height:100%;
            min-height:100vh;
        }
        .schedule-content{
            margin-left:25px;
            margin-right:25px;
        }
        .card-title {
          font-size:2rem;
          font-weight:500;
          text-align:left;
          margin-bottom:1.125rem;
          margin-top:1.563rem;
        }
        .table{
            margin-bottom:0px;
            --bs-table-bg:#F2F2F2;
            --bs-table-border-color:#000;
            align-items:center;
        }
        .table-title {
          font-size:1.25rem;
          margin-bottom:1.563rem;
        }
        .btn-page {
            position:absolute;
            right:4px;
            width:214px;
            height:60px;
            border:none;
            color:#000;
            background:#F2F2F2;
            font-size:20px;
            font-weight:500;
        }
        .tHead {
            font-size:0.938rem;
        }
        .tBody {
            font-size:0.75rem;
        }
    </style>
    <script src="{{ asset('js/loadContent.js') }}"></script>
    <script type="module" src="{{ asset('js/main.js') }}"></script>
</body>
</html>
