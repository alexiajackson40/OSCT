@extends('layouts.app')

@section('content')
<div class="main-content">
    <div class="document-container mt-5">
        <div class="card">
            <div class="top-buttons d-flex flex-row align-self-center">
                <a id="back-btn" class="btn-back" href="{{ url('admin/users/patient') }}">&lt; Go Back</a>
                <button class="btn-edit">[Upload Document]</button>
            </div>
            <div class="card-body d-flex flex-column">
                <div class="document-content">
                    <h1 class="card-title">Documents</h1>
                    <h2 class="table-title">Patient Documents</h2>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Document Name</th>
                                <th>Date Assigned</th>
                                <th>Download Link</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($documents as $document)
                                <tr>
                                    <td>{{ $document->name }}</td>
                                    <td>{{ $document->date_assigned }}</td>
                                    <td><a href="{{ Storage::url($document->file_path) }}" target="_blank">Download</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="button-container mt-5 d-flex flex-column">
        <a class="record-btn btn-primary" href="{{ url('admin/users/patient/profile') }}">Patient Profile</a>
        <a class="record-btn btn-primary" href="{{ url('admin/users/patient/measurements') }}">Measurements</a>
        <a class="record-btn btn-primary" href="{{ url('admin/users/patient/documents') }}">Documents</a>
        <a class="record-btn btn-primary" href="{{ url('admin/users/patient/lab-results') }}">Lab Results</a>
    </div>
</div>
@endsection
