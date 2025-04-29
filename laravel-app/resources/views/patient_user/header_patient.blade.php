<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Import Bootstrap and Custom Styles -->
    <link href="{{ asset('theme.css') }}" rel="stylesheet">
    <link href="{{ asset('style.css') }}" rel="stylesheet">
    <script src="{{ asset('bootstrap.min.js') }}" defer></script>
    <script src="{{ asset('loadContent.js') }}" defer></script>
</head>
<body>
    <div class="container-fluid main-body">
        <div class="header-container d-flex flex-row align-items-center"> 
            <!--Logo-->
            <div class="media">
                <img src="{{ asset('img/logoWhite.png') }}" alt="logo" width="45" height="60">
            </div>
            <!--Project name-->
            <div class="project-title-container ms-3">
                <h1 class="project-title m-0" style="font-size: 2rem;">OSCT</h1>
                <h2 class="project-subtitle" style="font-size: 1.125rem; font-weight: 400;">Operación Salud Colima Tamizaje</h2>
            </div>
            <!--Profile Button with Dropdown-->
            <div class="user-container dropdown ms-auto">
                <a id="profile" class="btn btn-light d-flex align-items-center dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{ asset('img/blank_profile.png') }}" class="img-thumbnail rounded-circle me-2" alt="profile logo" width="45" height="45">
                    <span class="user-text">{{ auth()->user()->username ?? 'Username' }}</span> <!-- Dynamically show the logged-in user's username --> 
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profile">
                    <li><a class="dropdown-item" id="profile-button" href="{{ route('patient.profile') }}">Ver Perfil</a></li>
                    <li>
                        <form action="{{ route('parent.logout') }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="dropdown-item">Desconectar</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!--Navigation Bar-->
    <div class="navigation-container">
        <nav class="nav nav-pills nav-fill">
            <a class="nav-link {{ request()->is('patient/home') ? 'active' : '' }}" href="{{ route('patient.home') }}">Hogar</a>
            <a class="nav-link {{ request()->is('patient/schedule') ? 'active' : '' }}" href="{{ route('patient.schedule') }}">Cronograma</a>
            <a class="nav-link {{ request()->is('patient/lab-results') ? 'active' : '' }}" href="{{ route('patient.lab_results') }}">Resultados de laboratorio</a>
            <a class="nav-link {{ request()->is('patient/documents') ? 'active' : '' }}" href="{{ route('patient.documents') }}">Documentos</a>
        </nav>
    </div>
<style>
    /* Styling for Containers*/
    .main-body {
        background-color: var(--primary-red);
    }
    .header-container {
        background-color: var(--primary-red);
        align-items: center;
        height: 5rem;
    }
    .project-title-container {
        color: var(--white);
        text-align: left;
        margin-left: 1rem;
    }
    .user-container {
        display: flex;
        align-items: center;
        margin-left: auto;
        margin-right: 1rem;
    }
    /*-----------------------------------*/
    /* Styling for Text*/
    .user-text {
        color: var(--dark-surface-three);
        font-size: 1.15rem;
        font-weight: 600;
        margin-right: 0.5rem;
    }
    /*-----------------------------------*/
    /* Styling for Profile Button*/
    .btn {
        --bs-btn-border-radius: 0.9375rem !important;
        width: 100%;
        height: 3.125rem;
        border: 0.125rem solid var(--light-surface-three);
        cursor: pointer;
    }
    .img-thumbnail {
        background: none;
        border-radius: 3.125rem;
        border-width: 0.0625rem;
        border-color: transparent;
        padding: 0.2rem;
    }
    .dropdown-menu {
        font-size: 1.15rem;
    }
    .dropdown-item {
        width: 100%;
        min-width: 12rem;
        height: 2.5rem;
    }
    /*-----------------------------------*/
    /* Styling for Navigation Bar */
    .nav-pills .nav-link {
        color: black !important;
        --bs-nav-pills-border-radius: 0;
        width: 7.8125rem !important;
        font-weight: 600;
        --bs-nav-link-font-size: 1.25rem !important;
    }
    .nav-pills .nav-link.active {
        color: black !important;
        background-color: var(--light-surface-three) !important;
        border-bottom: 0.25rem solid #7C1332 !important;
        font-weight: 600;
        width: 7.8125rem !important;
        height: 3.75rem !important;
    }
    .nav-pills .nav-link:hover {
        color: #7C1332 !important;
        background-color: var(--light-surface-three) !important;
    }
    .nav-pills .nav-link:not(.active):not(:hover) {
        color: black !important;
    }
    .nav {
        background-color: white !important;
        box-shadow: 0rem 0rem 0.25rem 0rem rgba(0, 0, 0, 0.25) !important;
        height: 3.75rem !important;
        --bs-nav-link-padding-x: 1rem !important;
        --bs-nav-link-padding-y: 1rem !important;
    }
    /*-----------------------------------*/
</style>
</body>
</html>
