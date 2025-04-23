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
          <h3 class="form-title mb-4">Parent Signup</h3>
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
                  <label for="firstName">First Name</label>
                  <input type="text" class="form-control" id="firstName" name="first_name" placeholder="First name" required>
                </div>
                <div class="mb-3">
                  <label for="lastName">Last Name</label>
                  <input type="text" class="form-control" id="lastName" name="last_name" placeholder="Last name" required>
                </div>
                <div class="mb-3">
                  <label for="username">Username</label>
                  <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                </div>
                <div class="mb-3">
                  <label for="email">Email (optional)</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="Email (optional)">
                </div>
                <div class="mb-3">
                  <label for="password">Password</label>
                  <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                </div>
                <div class="mb-3">
                  <label for="password_confirmation">Confirm Password</label>
                  <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" required>
                </div>
                <div class="mb-3">
                  <label for="CURP">Student ID (CURP)</label>
                  <input type="text" id="CURP" name="CURP" class="form-control" placeholder="Student ID (CURP)" required>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Register</button>
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