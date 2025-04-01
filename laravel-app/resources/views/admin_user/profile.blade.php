@extends('layouts.app')

@section('content')
<div class="main-content">
    <div class="profile-container mt-5">
        <div class="card">
            <button class="btn-page btn-primary">[Edit Information]</button>
            <div class="card-body d-flex flex-column align-self-center">
                <h1 class="card-title">User Name</h1>
                <div class="information-container">
                    <h2 class="container-header">User Information</h2>
                    <table class="info-table">
                        <tr><td><strong>Position</strong></td><td>Position Title</td></tr>
                    </table>
                </div>
                <div class="contact-container">
                    <h2 class="container-header">Contact Information</h2>
                    <table class="info-table">
                        <tr><td><strong>Email</strong></td><td>email@</td></tr>
                        <tr><td><strong>Phone #</strong></td><td>(xxx)xxx-xxxx</td></tr>
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
    min-height:100vh;
}
.profile-container {
    width:70%;
    display:flex;
    justify-content:center;
}
.card {
    background-color:#F2F2F2;
    width:545px;
    height:377px;
    position:relative;
}
.card-body {
    padding-top:10px;
}
.card-title {
    font-size:32px;
    font-weight:500;
    margin-top:40px;
}
.container-header {
    font-size:20px;
    font-weight:500;
    padding-left:14px;
    padding-top:14px;
}
.information-container,
.contact-container {
    margin-top:12px;
    width:449px;
    border:1px solid rgba(0, 0, 0, 0.30);
    background:#FFF;
    border-radius:6px;
}
.info-table {
    margin-left:14px;
    font-size:16px;
    font-weight:400;
    color:#000;
}
.btn-page {
    position:absolute;
    right:4px;
    width:214px;
    height:60px;
    border:none;
    font-size:20px;
    font-weight:500;
    text-decoration:underline;
}
</style>
@endpush
