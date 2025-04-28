<!DOCTYPE html>
<html lang="es">
<head>
    <link href="{{ asset('theme.css') }}" rel="stylesheet">
    <link href="{{ asset('style.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
</head>
<body>
    <div id="header"></div>
    <div class="main-content">
        <div class="form-container mt-5">
            <div class="card">
                <div class="card-body d-flex flex-column">
                    <div class="user-form">
                        <form method="POST" action="{{ route('add-user.store') }}" class="needs-validation" novalidate>
                            @csrf
                            <div class="form-row">
                                <div class="mb-3">
                                    <label for="first_name">Nombre</label>
                                    <input type="text" name="first_name" class="form-control" id="first_name" placeholder="Nombre" required>
                                </div>
                                <div class="mb-3">
                                    <label for="last_name">Apellido</label>
                                    <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Apellido" required>
                                </div>
                                <div class="mb-3">
                                    <label for="username">Nombre de usuario</label>
                                    <div class="input-group">
                                        <span class="input-group-text">@</span>
                                        <input type="text" name="username" class="form-control" id="username" placeholder="Nombre de usuario" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="email">Correo electrónico</label>
                                    <input type="email" name="email" class="form-control" id="email" placeholder="Correo electrónico" required>
                                </div>
                                <div class="mb-3">
                                    <label for="phone">Número de teléfono</label>
                                    <input type="text" name="phone" class="form-control" id="phone" placeholder="(xxx)xxx-xxxx" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password">Contraseña</label>
                                    <input type="password" name="password" class="form-control" id="password" placeholder="Contraseña" required>
                                </div>
                                <div class="mb-3">
                                    <label for="role">Rol</label>
                                    <select name="role" class="form-control" id="role" required>
                                        <option value="admin">Administrador</option>
                                        <option value="personnel">Personal de Salud</option>
                                        <option value="patient">Paciente</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="agree_terms" id="agree_terms" required>
                                    <label class="form-check-label" for="agree_terms">
                                        Aceptar términos y condiciones
                                    </label>
                                </div>
                            </div>
                            <button class="btn btn-primary" type="submit">Enviar formulario</button>
                        </form>
                    </div>
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
    }
    .card {
        background-color: #F2F2F2;
        width: 500px;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .user-form {
        display: flex;
        max-width: 500px;
        width: 100%;
        flex-direction: column;
        justify-content: center;
        align-items: center;    
    }
    .form-row {
        margin-top: 10px;
        display: flex;
        width: 100%;
        flex-direction: column;
        color: #000;
    }
    .form-control {
        width: 360px;
    }
</style>
<script src="{{ asset('js/loadContent.js') }}"></script>
<script type="module" src="{{ asset('js/main.js') }}"></script>
</html>
