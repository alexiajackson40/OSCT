@extends('layouts.app')

@section('content')
<div class="main-content">
    <div class="schedule-container mt-5">
        <div class="card">
            <button class="btn-page btn-primary">[Update Schedule]</button>
            <div class="card-body d-flex flex-column">
                <div class="schedule-content">
                    <h1 class="card-title">Schedule</h1>
                    <h2 class="table-title">Example Schedule Display Filler</h2>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name of School</th>
                                <th>Location</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr><td>FRANCISCO HERNANDEZ ESPINOSA</td><td>COLIMA</td><td>LUNES 23/09/24</td></tr>
                            <tr><td>JESÚS SILVERIO CAVAZOS CEBALLOS</td><td>COLIMA</td><td>LUNES 23/09/24</td></tr>
                            <tr><td>JESUS ALCARAZ RODRIGUEZ</td><td>LA ESPERANZA</td><td>LUNES 23/09/24</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.main-content {
    display:flex;
    justify-content:center;
    width:100%;
    align-items:center;
    min-height:100vh;
}
.schedule-container {
    width:70%;
}
.card {
    background-color:#F2F2F2;
    min-height:100vh;
}
.schedule-content {
    margin-left:25px;
    margin-right:25px;
}
.card-title {
    font-size:32px;
    font-weight:500;
    margin-top:25px;
    margin-bottom:25px;
}
.table {
    margin-bottom:0;
    --bs-table-bg:#F2F2F2;
    --bs-table-border-color:#000;
    text-align:center;
}
.table-title {
    font-size:20px;
    margin-bottom:20px;
}
.btn-page {
    position:absolute;
    right:4px;
    width:214px;
    height:60px;
    border:none;
    font-size:20px;
    font-weight:500;
}
</style>
@endpush
