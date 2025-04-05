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
    <div id="header"></div>
    <div class="main-content">
        <div class="form-container mt-5"> <!-- mt-5: larger top margin -->
          <div class="card">
            <div class="card-body d-flex flex-column"> <!-- Makes card customizable -->
                <div class="user-form">
                    <!-- Laravel form submission -->
                    <form method="POST" action="{{ route('add-user.store') }}" class="needs-validation" novalidate>
                        @csrf <!-- CSRF Token for security -->
                        <div class="form-row">
                          <div class="mb-3">
                            <label for="first_name">First Name</label>
                            <input type="text" name="first_name" class="form-control" id="first_name" placeholder="First Name" required>
                            <div class="valid-feedback">
                              Looks good!
                            </div>
                          </div>
                          <div class="mb-3">
                            <label for="last_name">Last Name</label>
                            <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Last Name" required>
                            <div class="valid-feedback">
                              Looks good!
                            </div>
                          </div>
                          <div class="mb-3">
                            <label for="student_id">Student ID</label>
                            <input type="text" name="student_id" class="form-control" id="student_id" placeholder="ID" required>
                            <div class="invalid-feedback">
                              Please provide a valid ID.
                            </div>
                          </div>
                          <div class="mb-3">
                            <label for="phone_number">Phone Number</label>
                            <input type="text" name="phone_number" class="form-control" id="phone_number" placeholder="(xxx)xxx-xxxx" required>
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
                              <input type="text" name="username" class="form-control" id="username" placeholder="Username" aria-describedby="inputGroupPrepend" required>
                              <div class="invalid-feedback">
                                Please choose a username.
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="form-group">
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="agree_terms" id="agree_terms" required>
                            <label class="form-check-label" for="agree_terms">
                              Agree to terms and conditions
                            </label>
                            <div class="invalid-feedback">
                              You must agree before submitting.
                            </div>
                          </div>
                        </div>

                        <button class="btn btn-primary" type="submit">Submit form</button>
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
