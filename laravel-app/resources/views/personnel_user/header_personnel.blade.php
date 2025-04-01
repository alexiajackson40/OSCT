<!-- resources/views/components/header_personnel.blade.php -->
<div class="container-fluid main-body">
    <div class="header-container d-flex flex-row"> 
        <div class="media">
            <img src="{{ asset('img/logoWhite.png') }}" alt="logo" width="45" height="60">
        </div>
        <div class="project-title-container">
            <h1 class="project-title">OSCT</h1>
            <h2 class="project-subtitle">Operación Salud Colima Tamizaje</h2>
        </div>
        <div class="user-container ms-auto">
            <a class="btn btn-light d-flex align-items-center" href="{{ route('personnel.profile') }}">
                <img src="{{ asset('img/The_Donkey.JPEG') }}" class="img-thumbnail rounded-circle me-2" alt="profile" width="45" height="45">
                <span class="user-text">Profile</span>
            </a>
        </div>
    </div>
</div>

<div class="navigation-container">
    <nav class="nav nav-pills nav-fill">
        <a class="nav-link {{ request()->is('personnel/home') ? 'active' : '' }}" href="{{ route('personnel.home') }}">Home</a>
        <a class="nav-link {{ request()->is('personnel/users') ? 'active' : '' }}" href="{{ route('personnel.users') }}">Users</a>
        <a class="nav-link {{ request()->is('personnel/schedule') ? 'active' : '' }}" href="{{ route('personnel.schedule') }}">Schedule</a>
    </nav>
</div>
