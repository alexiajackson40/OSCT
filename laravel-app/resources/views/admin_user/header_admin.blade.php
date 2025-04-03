<!DOCTYPE html>
<html lang="en">
<body>
    <div class="container-fluid main-body">
        <div class="header-container d-flex flex-row">
            <div class="media">
                <img src="{{ asset('img/logoWhite.png') }}" alt="logo" width="45" height="60">
            </div>
            <div class="project-title-container">
                <h1 class="project-title" style="font-size: 2rem; margin-bottom: 0;">OSCT</h1>
                <h2 class="project-subtitle" style="font-size: 1.125rem; font-weight: 400;">Operación Salud Colima Tamizaje</h2>
            </div>
            <div class="user-container dropdown">
                <a id="profile" class="btn btn-light d-flex align-items-center dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{ asset('img/The_Donkey.JPEG') }}" class="img-thumbnail rounded-circle me-2" alt="logo" width="45" height="45">
                    <span class="user-text">{{ auth()->user()->username ?? 'Username' }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profile">
                    <li><a class="dropdown-item" href="{{ route('admin.profile') }}">View Profile</a></li>
                    <li>
                        <!-- Logout Form -->
                        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="dropdown-item">Sign Out</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="navigation-container">
        <nav class="nav nav-pills nav-fill">
            <a class="nav-link" href="{{ route('admin.home') }}">Home</a>
            <a class="nav-link" href="{{ route('admin.adminUsers') }}">Users</a>
            <a class="nav-link" href="{{ route('schedule.index') }}">Schedule</a>
        </nav>
    </div>
    <style>
        /* Styles for the header */
        .main-body {
            background-color: var(--primary-red);
        }
        .header-container {
            background-color: var(--primary-red);
            align-items: center;
            height: 5rem;
        }
        .user-container {
            display: flex;
            align-items: center;
            margin-left: auto;
            margin-right: 1rem;
        }
        .user-text {
            font-size: 1.15rem;
            font-weight: 600;
            margin-right: 0.5rem;
        }
        .nav-pills .nav-link {
            color: black !important;
            font-weight: 600;
        }
        .nav-pills .nav-link.active {
            background-color: var(--light-surface-three) !important;
        }
    </style>
</body>
</html>
