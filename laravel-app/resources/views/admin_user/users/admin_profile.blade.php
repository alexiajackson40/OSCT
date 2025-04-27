<!DOCTYPE html>
<html lang="es">
<head>
     <!-- Import Bootstrap and Custom Styles -->
     <link href="{{ asset('theme.css') }}" rel="stylesheet">
     <link href="{{ asset('style.css') }}" rel="stylesheet">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
</head>
<!-- Admin User Profile Page -->
<body>
    <!-- Include the header dynamically -->
    @include('admin_user.header_admin')
    <div class="main-content">
        <div class="profile-container mt-5">
            <div class="card">
                <div class="top-buttons d-flex flex-row align-self-center">
                    <!-- Back Button -->
                    <a id="back-btn" class="btn-back" href="{{ route('admin.adminUsers') }}">&lt; Regresar</a>
                    <button class="btn-edit" data-bs-toggle="modal" data-bs-target="#editAdminModal">[Editar Información]</button>
                </div>
                <div class="card-body d-flex flex-column">
                    <!-- Admin Info -->
                    <h1 class="card-title">{{ $admin->first_name }} {{ $admin->last_name }}</h1>
                    <div class="information-container d-flex flex-column align-items-left">
                        <h2 class="container-header">Información del Usuario</h2>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>{{ $admin->first_name }} {{ $admin->last_name }}</th>
                                </tr>
                                <tr>
                                    <th>Correo Electrónico</th>
                                    <th>{{ $admin->email }}</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <!-- Contact Info -->
                    <div class="contact-container d-flex flex-column align-items-left">
                        <h2 class="container-header">Información de Contacto</h2>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Teléfono</th>
                                    <th>{{ $admin->phone ?? 'N/A' }}</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal for Editing Admin Information -->
    <div class="modal fade" id="editAdminModal" tabindex="-1" aria-labelledby="editAdminModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editAdminModalLabel">Editar Información del Administrador</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.updateAdmin', $admin->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="first_name">Nombre</label>
                            <input type="text" name="first_name" id="first_name" value="{{ $admin->first_name }}" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="last_name">Apellido</label>
                            <input type="text" name="last_name" id="last_name" value="{{ $admin->last_name }}" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Correo Electrónico</label>
                            <input type="email" name="email" id="email" value="{{ $admin->email }}" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Teléfono</label>
                            <input type="text" name="phone" id="phone" value="{{ $admin->phone }}" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<style>
    /* Styling for Containers*/
    .main-content {
        display: flex;
        justify-content: center;
        width: 100%;
        min-height: 100vh;
        background-color: var(--light-surface-one);
    }
    .profile-container {
        width: fit-content;
    }
    .card {
        background-color: #FAFAFA;
        width: fit-content;
        height: fit-content;
        display: flex;
        justify-content: center;
    }
    .card-body {
        margin-bottom: 1rem;
        margin-left: 0.625rem;
        margin-right: 0.625rem;
        padding-top: 0.625rem;
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    /*-----------------------------------*/
    /* Styling for Back and Edit Buttons*/
    .top-buttons {
        margin-top: 0.625rem;
        margin-bottom: 0.625rem;
        width: 28.063rem;
        padding-top: 0.625rem;
        display: flex;
        flex-direction: row;
    }
    .btn-back {
        position: absolute;
        left: 1.875rem;
        font-size: 1.25rem;
        font-weight: 500;
        border: none;
        color: #000;
        background: #FAFAFA;
        border-radius: 1rem;
        text-decoration: none;
    }
    .btn-back:hover {
        background-color: #E0E0E0;
    }
    .btn-edit {
        position: absolute;
        right: 1.875rem;
        border: none;
        color: #000;
        background: #FAFAFA;
        font-size: 1.25rem;
        font-weight: 500;
        border-radius: 1rem;
    }
    .btn-edit:hover {
        background-color: #E0E0E0;
    }
    /*-----------------------------------*/
    /* Styling Title*/
    .card-title {
        font-size: 2rem;
        font-weight: 500;
        margin-top: 2.5rem;
        width: 28.063rem;
    }
    /*-----------------------------------*/
    /* Styling for Table*/
    .container-header {
        font-size: 1.25rem;
        font-weight: 500;
        padding-left: 0.875rem;
        padding-top: 0.875rem;
    }
    .information-container,
    .contact-container {
        margin-top: 0.75rem;
        width: 28.063rem;
        height: auto;
        border-radius: 0.375rem;
        border: 0.063rem solid rgba(0,0,0,0.30);
        background: #FFF;
    }
    .table {
        margin-left: 0.875rem;
        color: #000;
        font-size: 1rem;
        font-weight: 400;
        width: auto;
    }
</style>
</html>
