<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Import Bootstrap and Custom Styles -->
    <link href="{{ asset('theme.css') }}" rel="stylesheet">
    <link href="{{ asset('style.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
</head>
<body>
    @include('personnel_user.header_personnel')
    <div class="main-content">
        <div class="form-container mt-5">
            <div class="card">
                <div class="card-body d-flex flex-column">
                    <h2 class="card-title">Editar Perfil</h2>
                    <form method="POST" action="{{ route('personnel.updateProfile', $user->employee_id) }}" class="needs-validation" novalidate>
                        @csrf
                        @method('PUT')
                        <div class="form-row">
                            <div class="mb-3">
                                <label for="first_name">Nombre</label>
                                <input type="text" name="first_name" class="form-control" id="first_name" value="{{ $user->first_name }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="last_name">Apellido</label>
                                <input type="text" name="last_name" class="form-control" id="last_name" value="{{ $user->last_name }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="username">Nombre de Usuario</label>
                                <input type="text" name="username" class="form-control" id="username" value="{{ $user->username }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="email">Correo Electrónico</label>
                                <input type="email" name="email" class="form-control" id="email" value="{{ $user->email }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="phone">Número de Teléfono</label>
                                <input type="text" name="phone" class="form-control" id="phone" value="{{ $user->phone }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="address">Dirección</label>
                                <input type="text" name="address" class="form-control" id="address" value="{{ $user->address }}" required>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button class="btn btn-primary" type="submit">Actualizar Perfil</button>
                            <a href="{{ route('personnel.profile', $user->employee_id) }}" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<style>
    .main-content {
        display: flex;
        justify-content: center;
        width: 100%;
        min-height: 100vh;
        background-color: var(--light-surface-one);
    }
    .form-container {
        width: 100%;
        display: flex;
        justify-content: center;
    }
    .card-body {
        padding: 2rem;
    }
    .card {
        width: 30%;
        height: fit-content;
    }
    .card-title {
        font-size: 1.75rem;
        font-weight: 500;
        margin-bottom: 1.5rem;
    }
    .btn-primary {
        height: 3rem;
        border-radius: 0.5rem;
        font-weight: 500;
    }
    .btn-secondary {
        height: 3rem;
        border-radius: 0.5rem;
        font-weight: 500;
        background-color: #6c757d;
        color: white;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .btn-secondary:hover {
        background-color: #5a6268;
    }
</style>
</html>
