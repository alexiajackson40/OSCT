@extends('layouts.app')

@section('content')
<div class="main-content">
    <div class="home-container mt-5">
        <div class="card">
            <div class="card-body d-flex flex-column align-items-center">
                <div class="media mb-3">
                    <img src="/public/img/colimaGobiernoDelEstado.png" alt="logo" width="225" height="200">
                </div>
                <p class="card-text">Lorem ipsum dolor sit amet...</p>
                <!-- repeat paragraphs if needed -->
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
    align-items:center;
    min-height:100vh;
}
.home-container {
    width:70%;
}
.card-title {
    font-size:30px;
}
p {
    font-weight:500;
}
</style>
@endpush
