@extends('layouts.app')

@section('content')
<table class="table" id="documentsTable">
  <thead>
    <tr>
      <th>Document Name</th>
      <th>Date Assigned</th>
      <th>Download Link</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($documents as $doc)
    <tr>
      <td>{{ $doc->name }}</td>
      <td>{{ $doc->assigned_date }}</td>
      <td><a href="{{ asset('storage/documents/' . $doc->filename) }}" download>Download</a></td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection
