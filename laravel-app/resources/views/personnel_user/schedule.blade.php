<!-- resources/views/personnel_user/schedule.blade.php -->
@extends('layouts.app')

@section('content')
    @include('components.header_personnel')

    <div class="main-content">
        <div class="schedule-container mt-5">
            <div class="card">
                <button class="btn-page btn-primary">[Update Schedule]</button>
                <div class="card-body d-flex flex-column">
                    <h1 class="card-title">Personnel Schedule</h1>
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
                            @foreach ($scheduleData as $item)
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
@endsection
