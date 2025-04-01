@extends('layouts.app')

@section('content')
<div class="main-content">
    <div class="document-container mt-5">
        <div class="card">
            <div class="top-buttons d-flex flex-row align-self-center">
                <a class="btn-back" href="{{ url('/admin_user/users/patient_users') }}">&lt; Go Back</a>
                <button class="btn-edit">[Upload Document]</button>
            </div>
            <div class="card-body d-flex flex-column">
                <div class="document-content">
                    <h1 class="card-title">Documents</h1>
                    <h2 class="table-title">Example List of Documents Table</h2>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Document Name</th>
                                <th>Date Assigned</th>
                                <th>Download Link</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                use Illuminate\Support\Facades\Storage;
                                $json = Storage::get('public/test-data/patient_user/docData.json');
                                $data = json_decode($json, true) ?? [];
                            @endphp

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

    <div class="button-container mt-5 d-flex flex-column">      
        <a class="record-btn btn-primary" href="{{ url('/admin_user/users/patient_profile') }}">Patient Profile</a>
        <a class="record-btn btn-primary" href="{{ url('/admin_user/users/patient_measurements') }}">Measurements</a>
        <a class="record-btn btn-primary" href="{{ url('/admin_user/users/patient_documents') }}">Documents</a>
        <a class="record-btn btn-primary" href="{{ url('/admin_user/users/patient_labResults') }}">Lab Results</a>
    </div>
</div>
@endsection
