<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Import Bootstrap and Custom Styles -->
    <link href="{{ asset('theme.css') }}" rel="stylesheet">
    <link href="{{ asset('style.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
</head>
<body>
    @include('admin_user.header_admin')
    <div class="main-content">
        <div class="button-container mt-5 d-flex flex-column">
            <a class="table-btn btn-primary" role="button" href="{{ route('admin.patientUsers') }}">Alumnos</a>
            <a class="table-btn btn-primary" role="button" href="{{ route('admin.personnelUsers') }}">Personal de Salud</a>
            <a class="table-btn btn-primary active-btn" role="button" href="{{ route('admin.adminUsers') }}">Administradores</a>
        </div>
        <div class="users-container mt-5">
            <div class="card">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                <div class="card-head d-flex flex-row">
                    <h1 class="card-title">Administradores</h1>
                    <div class="addBtn-container d-flex flex-row align-items-right mb-4">
                        <button id="toggleAddAdminForm" class="btn btn-primary btn-new">+ Añadir Administrador</button>
                    </div>
                </div>

                <!-- Add New Admin Form -->
                <div id="addAdminForm" class="add-patient-form mb-4 p-4" style="display: none; margin-left: 1rem;">
                    <h2>Añadir Nuevo Administrador</h2>
                    <form action="{{ route('add-user.store') }}" method="POST" class="form-inline">
                        @csrf
                        <input type="hidden" name="role" value="admin">
                        <div class="form-group mb-2">
                            <label for="first_name">Nombre:</label>
                            <input type="text" name="first_name" id="first_name" class="form-control mx-sm-2" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="last_name">Apellido:</label>
                            <input type="text" name="last_name" id="last_name" class="form-control mx-sm-2" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="username">Nombre de Usuario:</label>
                            <input type="text" name="username" id="username" class="form-control mx-sm-2" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="email">Correo Electrónico:</label>
                            <input type="email" name="email" id="email" class="form-control mx-sm-2" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="phone">Teléfono:</label>
                            <input type="text" name="phone" id="phone" class="form-control mx-sm-2">
                        </div>
                        <div class="form-group mb-2">
                            <label for="password">Contraseña:</label>
                            <input type="password" name="password" id="password" class="form-control mx-sm-2" required>
                        </div>
                        <button type="submit" class="btn btn-primary mb-2">Agregar Administrador</button>
                    </form>
                </div>

                <div class="card-body d-flex flex-column">
                    <div class="document-content">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Correo Electrónico</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($admins as $admin)
                                    <tr>
                                        <td>{{ $admin->first_name }} {{ $admin->last_name }}</td>
                                        <td>{{ $admin->email }}</td>
                                        <td>
                                            <a href="{{ route('admin.users.admin_profile', $admin->id) }}" class="btn btn-primary btn-view btn-action">Ver Perfil</a>
                                            <form action="{{ route('admin.removeAdmin', $admin->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este administrador?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-action">Eliminar</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

<script>
    document.getElementById('toggleAddAdminForm').addEventListener('click', function () {
        const form = document.getElementById('addAdminForm');
        const isHidden = form.style.display === 'none';
        form.style.display = isHidden ? 'block' : 'none';
    });
</script>

<style>
    /* Styling for Page Containers*/
    .main-content {
        display: flex;
        justify-content: left;
        width: 100%;
        min-height: 100vh;
        background-color: var(--light-surface-one);
    }
    .users-container {
        width: 70%;
    }
    .card {
        background-color: #FAFAFA;
        height: 100%;
        min-height: 100vh;
        display: flex;
    }
    .document-content {
        margin-left: 1.5625rem;
        margin-right: 1.5625rem;
    }
    .card-head{
        width: 93%;
        display: flex;
        justify-content: space-between;
        align-self: center;
        margin-top: 0.5rem;
    }
    .button-container {
        width: 13.375rem;
        height: fit-content;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-right: 0.5rem;
        margin-left: 0.5rem;
        gap: 0.5rem;
    }
    .table-btn {
        width: 100%;
        height: 3.75rem;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 0.5rem;
        background: #7C1332;
        box-shadow: 0rem 0.25rem 0.25rem 0rem rgba(0, 0, 0, 0.25);
        color: #FFF;
        font-size: 1.25rem;
        font-weight: 500;
        text-decoration: none;
    }
    .table-btn:hover {
        background-color: #52051C;
    }
    .active-btn {
        background: #808080;
        box-shadow: 0rem 0.25rem 0.25rem 0rem rgba(0, 0, 0, 0.25) inset;
    }
    .card-title {
        font-size: 2.2rem;
        font-weight: 500;
        text-align: left;
        margin-bottom: 1.5625rem;
        margin-top: 2.5rem;
    }
    .addBtn-container {
        margin-left: 1rem;
        margin-top: 1rem;
    }
    .btn-new {
        width: fit-content;
        height: 3rem;
        display: flex;
        align-items: center;
        border-radius: 0.5rem;
        font-weight: 500;
    }
    .btn-import {
        width: fit-content;
        height: 3rem;
        display: flex;
        align-items: center;
        border-radius: 0.5rem;
        font-weight: 500;
    }
    .table {
        align-items: center;
        margin-bottom: 0rem;
        --bs-table-bg: white;
        --bs-table-border-color: #000;
        border: 0.063rem solid #000000;
    }
    .btn-danger {
        height: 3rem;
        display: flex;
        align-items: center;
        border-radius: 0.5rem;
        font-weight: 500;
        justify-content: center;
    }
    .btn-view {
        height: 3rem;
        display: flex;
        align-items: center;
        border-radius: 0.5rem;
        font-weight: 500;
        justify-content: center;
    }
</style>

</body>
</html>
