<!DOCTYPE html>
<html lang="en">
<!-- Patient User Sign_up Page -->
<head>
    <!-- Import Bootstrap and Custom Styles -->
    <link href="{{ asset('theme.css') }}" rel="stylesheet">
    <link href="{{ asset('style.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
</head>
<body>
  <div class="main-page">
    <div class="main-content">
      <div class="card mt-5">
        <div class="card-body d-flex flex-column">
          <h3 class="form-title mb-4">Registro de padres</h3>
          <div class="user-form">
            <!-- Success Message -->
            @if(session('success'))
              <div class="alert alert-success">
                {{ session('success') }}
              </div>
            @endif
            <!-- Error Validation -->
            @if($errors->any())
              <div class="alert alert-danger">
                <ul class="mb-0">
                  @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif
            <form method="POST" action="{{ route('signup') }}">
              @csrf
              <div class="form-row">
                <div class="mb-3">
                  <label for="firstName">Nombre de pila</label>
                  <input type="text" class="form-control" id="firstName" name="first_name" placeholder="Nombre de pila" required>
                </div>
                <div class="mb-3">
                  <label for="lastName">Apellido</label>
                  <input type="text" class="form-control" id="lastName" name="last_name" placeholder="Apellido" required>
                </div>
                <div class="mb-3">
                  <label for="username">Nombre de usuario</label>
                  <input type="text" class="form-control" id="username" name="username" placeholder="Nombre de usuario" required>
                </div>
                <div class="mb-3">
                  <label for="email">Correo electrónico (opcional)</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="Correo electrónico (opcional)">
                </div>
                <div class="mb-3">
                  <label for="password">Contraseña</label>
                  <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" required>
                </div>
                <div class="mb-3">
                  <label for="password_confirmation">Confirmar Contraseña</label>
                  <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirmar Contraseña" required>
                </div>
                <div class="mb-3">
                  <label for="CURP">Credencial de estudiante (CURP)</label>
                  <input type="text" id="CURP" name="CURP" class="form-control" placeholder="Credencial de estudiante (CURP)" required>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Registro</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
<style>
  /* Styling for Containers*/
  .main-page {
      display: flex;
      justify-content: center;
      width: 100%;
      min-height: 100vh;
  }
  .main-content {
      width: 35%;
  }
  .card {
      background-color: #FAFAFA;
      width: auto;
      height: fit-content;
      display: flex;
      justify-content: center;
  }
  .card-body {
      padding: 2rem 4rem 2rem 4rem;
  }
  /*-----------------------------------*/
  /* Styling for Button*/
  .btn {
      height: 3rem;
      width: 13rem;
      display: flex;
      align-items: center;
      border-radius: 0.5rem;
      font-weight: 500;
      justify-content: center;
  }
  /*-----------------------------------*/
</style>
</html>