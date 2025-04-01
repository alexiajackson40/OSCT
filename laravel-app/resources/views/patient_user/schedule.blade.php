@extends('layouts.app')

@section('content')
<div class="main-content">
    <div class="schedule-container mt-5">
        <div class="card">
            <div class="card-body d-flex flex-column">
                <div class="schedule-content">
                    <h1 class="card-title">Programación vista a Planteles Escolares</h1>
                    <h2 class="table-title">Operación Salud Colima Tamizaje</h2>
                    @php
                        use Illuminate\Support\Facades\Storage;
                        $json = Storage::get('public/test-data/patient_user/scheduleData.json');
                        $data = json_decode($json, true)['data'] ?? [];
                    @endphp
                    <table class="table">
                        <thead><tr><th>Nombre</th><th>Localidad</th><th>Fecha</th></tr></thead>
                        <tbody>
                            @foreach($data as $item)
                                <tr>
                                    <td>{{ $item['nombre'] ?? 'N/A' }}</td>
                                    <td>{{ $item['localidad'] ?? 'N/A' }}</td>
                                    <td>{{ $item['fecha'] ?? 'N/A' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
