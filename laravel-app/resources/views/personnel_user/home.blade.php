<!-- resources/views/personnel_user/home.blade.php -->
@extends('layouts.app')

@section('content')
    @include('components.header_personnel')

    <div class="main-content">
        <div class="home-container mt-5">
            <div class="card">
                <div class="card-body d-flex flex-column align-items-center">
                    <div class="media mb-3">
                        <img src="{{ asset('img/colimaGobiernoDelEstado.png') }}" alt="logo" width="225" height="200">
                    </div>
                    <p class="card-text">[Place your informational text here]</p>
                </div>
            </div>
        </div>
    </div>
@endsection
