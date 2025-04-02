<!DOCTYPE html>
<html lang="en">
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
                            <label for="first_name">First name</label>
                            <input type="text" name="first_name" class="form-control" id="first_name" placeholder="First name" required>
                            <div class="valid-feedback">
                              Looks good!
                            </div>
                          </div>
                          <div class="mb-3">
                            <label for="last_name">Last name</label>
                            <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Last name" required>
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
                            <input type="text" name="username" class="form-control" id="username" placeholder="Username" required>
                            <div class="invalid-feedback">
                              Please choose a username.
                            </div>
                          </div>
                          <div class="mb-3">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
                            <div class="invalid-feedback">
                              Please provide a password.
                            </div>
                          </div>
                          <div class="mb-3">
                            <label for="password_confirmation">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Confirm Password" required>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="agree_terms" id="invalidCheck" required>
                            <label class="form-check-label" for="invalidCheck">
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
        display:flex;
        justify-content:center;
        width:100%;
        min-height:100vh;
    }
    .card {
        background-color:#F2F2F2;
        width:500px;
        display:flex;
        justify-content:center;
        align-items:center;
    }
    .user-form {
        display:flex;
        max-width:500px;
        width:100%;
        flex-direction:column;
        justify-content:center;
        align-items:center;    
    }
    .form-row {
        margin-top:10px;
        display:flex;
        width:100%;
        flex-direction:column;
        color:#000;
  }
    .form-control {
        width: 360px;
    }
</style>
</html>
