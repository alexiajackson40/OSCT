<div class="container-fluid main-body">
    <div class="header-container d-flex flex-row"> 
        <div class="media">
            <img src="/public/img/logoWhite.png" alt="logo" width="45" height="60">
        </div>
        <div class="project-title-container">
            <h1 class="project-title" style="font-size: 2rem; margin-bottom: 0;">OSCT</h1>
            <h2 class="project-subtitle" style="font-size: 1.125rem; font-weight: 400;">Operación Salud Colima Tamizaje</h2>
        </div>
        <div class="user-container ms-auto">
            <a id="profile-button" class="btn btn-light d-flex align-items-center" href="{{ route('patient.profile') }}">
                <img src="/public/img/The_Donkey.JPEG" class="img-thumbnail rounded-circle me-2" alt="logo" width="45" height="45">
                <span class="user-text">Profile</span>
            </a>
        </div>
    </div>
</div>

<div class="navigation-container">
    <nav class="nav nav-pills nav-fill">
        <a class="nav-link" href="{{ route('patient.home') }}">Home</a>
        <a class="nav-link" href="{{ route('patient.schedule') }}">Schedule</a>
        <a class="nav-link" href="{{ route('patient.lab_results') }}">Lab Results</a>
        <a class="nav-link" href="{{ route('patient.documents') }}">Documents</a>
    </nav>
</div>
