<!DOCTYPE html>
<html lang="en">
<head>
     <!-- Import Bootstrap and Custom Styles -->
     <link href="{{ asset('theme.css') }}" rel="stylesheet">
     <link href="{{ asset('style.css') }}" rel="stylesheet">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
</head>
<!-- Add User Form -->
<body>
  <div class="page-content">
    <div class="form-container">
      <div class="card">
        <div class="card-body d-flex flex-column">
            <div class="user-form">
                <form method="POST" action="{{ route('signup') }}">
                    @csrf
                    <div class="form-row">
                      <div class="mb-3">
                        <label for="firstName">First name</label>
                        <input type="text" class="form-control" id="firstName" name="first_name" placeholder="First name" required>
                        <div class="valid-feedback">
                          Looks good!
                        </div>
                      </div>
                      <div class="mb-3">
                        <label for="lastName">Last name</label>
                        <input type="text" class="form-control" id="lastName" name="last_name" placeholder="Last name" required>
                        <div class="valid-feedback">
                          Looks good!
                        </div>
                      </div>
                      <div class="mb-3">
                        <label for="studentID">Student ID</label>
                        <input type="text" class="form-control" id="studentID" name="student_id" placeholder="ID" required>
                        <div class="invalid-feedback">
                          Please provide a valid ID.
                        </div>
                      </div>
                      <div class="mb-3">
                        <label for="phoneNum">Phone Number</label>
                        <input type="text" class="form-control" id="phoneNum" name="phone_number" placeholder="(xxx)xxx-xxxx" required>
                        <div class="invalid-feedback">
                          Please provide a valid number.
                        </div>
                      </div>
                      <div class="mb-3">
                        <label for="username">Username</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupPrepend">@</span>
                          </div>
                          <input type="text" class="form-control" id="username" name="username" placeholder="Username" aria-describedby="inputGroupPrepend" required>
                          <div class="invalid-feedback">
                            Please choose a username.
                          </div>
                        </div>
                      </div>
                      <div class="mb-3">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                        <div class="invalid-feedback">
                          Please provide a valid password.
                        </div>
                      </div>
                    </div>
                    <button class="btn btn-primary" type="submit">Submit form</button>
                    <div class="signIn-container">
                      <p>
                        Already have an account?
                        <a id="signIn-btn" class="btn-signIn" href="{{ route('login') }}">Sign In</a>
                      </p>
                    </div>
                </form>
            </div>
        </div>
      </div>
    </div>
  </div>

  <script src="{{ asset('src/loadContent.js') }}"></script>
  <script type="module" src="{{ asset('src/main.js') }}"></script>
</body>

<style>
  .page-content {
    background: #F9F9F9;
  }
  .form-container {
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
  }
  .card {
    width: 500px;
    height: 600px;
    display: flex;
    justify-content: center;
    align-items: center;
    background: #FAFAFA;
    border-radius: 14px;
    border: 1px solid rgba(0, 0, 0, 0.20);
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
  .signIn-container {
    margin-top: 1rem;
  }
</style>
</html>
