@extends('layouts.app')

@section('content')
<div class="main-content">
    <div class="labresults-container mt-5">
        <div class="card">
            <div class="card-body d-flex flex-column">
                <div class="document-content">
                    <h1 class="card-title">Lab Results</h1>
                    <h2 class="table-title">List of Available Lab Reports</h2>
                    @php
                        use Illuminate\Support\Facades\Storage;
                        $json = Storage::get('public/test-data/patient_user/labData.json');
                        $data = json_decode($json, true) ?? [];
                    @endphp
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Document Name</th>
                                <th>Date Assigned</th>
                                <th>Download Link</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $item['name'] ?? 'N/A' }}</td>
                                    <td>{{ $item['date'] ?? 'N/A' }}</td>
                                    <td>
                                        @if(isset($item['link']))
                                            <a href="{{ $item['link'] }}" target="_blank">Download</a>
                                        @else
                                            N/A
                                        @endif
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
@endsection
