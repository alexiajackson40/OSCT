@extends('layouts.app')

@section('content')
<div class="main-content">
    <div class="document-container mt-5b">
        <div class="card">
            <div class="top-buttons d-flex flex-row align-self-center">
                <a href="{{ url('/admin_user/users/patient_users') }}" class="btn-back">&lt; Go Back</a>
                <button class="btn-edit">[Upload Document]</button>
            </div>
            <div class="card-body d-flex flex-column">
                <div class="document-content">
                    <h1 class="card-title">Lab Results</h1>
                    <h2 class="table-title">Example List of Lab Results</h2>
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
                                $json = Storage::get('public/test-data/patient_user/labData.json');
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
    @include('admin_user.users.partials.patient_nav')
</div>
@endsection
