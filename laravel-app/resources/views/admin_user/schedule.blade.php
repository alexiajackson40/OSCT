<!DOCTYPE html>
<html lang="en">
<body>
    <!-- Include the header -->
    @include('admin_user.header_admin')
    <div class="main-content">
        <div class="schedule-container mt-5">
            <div class="card">
                <button class="btn-page btn-primary">[Update Schedule]</button>
                <div class="card-body d-flex flex-column">
                    <div class="schedule-content">
                        <h1 class="card-title">Programación vista a Planteles Escolares</h1>
                        <h2 class="table-title">Operación Salud Colima Tamizaje</h2>
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
                                            <a href="{{ route('schedule.edit', $schedule->id) }}" class="btn btn-primary">Actualizar</a>
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
    .td a{
        display:flex;
        align-items:center;
        justify-content:center;
        color:#000;
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
</html>
