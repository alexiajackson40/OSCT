<!-- resources/views/layouts/header_patient.blade.php -->
<div class="header-container d-flex flex-row">
    <!-- Logo -->
    <div class="media">
        <img src="{{ asset('img/logoWhite.png') }}" alt="logo" width="45" height="60">
    </div>

    <!-- Project name -->
    <div class="project-title-container">
        <h1 class="project-title" style="font-size: 32px; margin-bottom: 0;">OSCT</h1>
        <h2 class="project-subtitle" style="font-size: 18px; font-weight: 400;">Operación Salud Colima Tamizaje</h2>
    </div>

    <!-- Profile Button -->
    <div class="user-container">
        <a class="btn btn-light" href="/profile-patient" role="button">
            <img src="{{ asset('img/The_Donkey.JPEG') }}" class="img-thumbnail" alt="profile" width="50" height="50">
            Profile
        </a>
    </div>
</div>

<!-- Navigation Bar -->
<div class="navigation-container">
    <nav class="nav nav-pills nav-fill">
        <a class="nav-link" href="/home-patient">Home</a>
        <a class="nav-link" href="/schedule-patient">Schedule</a>
        <a class="nav-link" href="/documents-patient">Documents</a>
    </nav>
</div>

<style>
    .header-container {
        background-color: #7C1332;
        height: 80px;
        align-items: center;
    }

    .project-title-container {
        color: white;
        text-align: left;
        margin-left: 16px;
    }

    .user-container {
        margin-left: auto;
        margin-right: 16px;
        align-items: center;
    }

    .btn {
        --bs-btn-border-radius: 10px;
        width: 120px;
        height: 50px;
        display: flex;
        column-gap: 2px;
        justify-content: space-between;
        align-items: center;
        border: 2px solid #ddd;
        border-radius: 10px;
        font-size: 16px;
        font-weight: 500;
    }

    .nav-pills .nav-link {
        color: black;
        font-weight: 600;
    }

    .nav-pills .nav-link.active {
        background-color: #7C1332;
        border-bottom: 4px solid #7C1332;
    }

    .nav-pills .nav-link:hover {
        color: #7C1332;
        background-color: #f1f1f1;
    }

    .nav {
        background-color: #f8f9fa;
        box-shadow: 0px 0px 4px rgba(0, 0, 0, 0.25);
        height: 60px;
    }
</style>
