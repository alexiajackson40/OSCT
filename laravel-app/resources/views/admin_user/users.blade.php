@extends('layouts.app')

@section('content')
<div class="main-content">
    <div class="button-container mt-5 d-flex flex-column">      
        <a class="table-btn btn-primary" href="{{ url('admin_user/users/patient_users') }}">Patients</a>
        <a class="table-btn btn-primary" href="{{ url('admin_user/users/personnel_users') }}">Personnel</a>
        <a class="table-btn btn-primary" href="{{ url('admin_user/users/admin_users') }}">Admin</a>
    </div>
    <div class="users-container mt-5">
        <div class="card">
            <button id="add-btn" class="btn-page btn-primary" data-page="admin_user/add_user">[Add/Remove User]</button>
            <div class="card-body d-flex flex-column">
                <div class="document-content">
                    <h1 class="card-title">Users</h1>
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
    justify-content:left;
    width:100%;
    min-height:100vh;
}
.users-container {
    width:70%;
}
.card {
    background-color:#F2F2F2;
    min-height:100vh;
}
.document-content {
    margin: 0 1.5625rem;
}
.card-title {
    font-size:2rem;
    font-weight:500;
    text-align:left;
    margin:1.563rem 0;
}
.button-container {
    width:13.375rem;
    height:13rem;
    display:flex;
    justify-content:space-around;
    align-items:center;
    margin: 0 0.5rem;
}
.table-btn {
    width:214px;
    height:60px;
    display:inline-flex;
    padding:18.5px 40px;
    justify-content:center;
    align-items:center;
    border-radius:8px;
    background:#6F1A34;
    color:#FFF;
    font-size:20px;
    font-weight:500;
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
