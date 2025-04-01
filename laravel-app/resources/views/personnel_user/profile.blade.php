<!-- resources/views/personnel_user/profile.blade.php -->
@extends('layouts.app')

@section('content')
    @include('components.header_personnel')

    <div class="main-content">
        <div class="profile-container mt-5">
            <div class="card">
                <button class="btn-page btn-primary">[Edit Information]</button>
                <div class="card-body d-flex flex-column align-self-center">
                    <h1 class="card-title">User Name</h1>
                    <div class="information-container d-flex flex-column align-items-left">
                        <h2 class="container-header">User Information</h2>
                        <table class="info-table">
                            <tr><td><strong>Position</strong></td><td>Position Title</td></tr>
                        </table>
                    </div>
                    <div class="contact-container d-flex flex-column align-items-left">
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
