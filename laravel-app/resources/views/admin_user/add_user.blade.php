<!DOCTYPE html>
<html lang="en">
<!-- Add User Form -->
<body>
    <div id="header"></div> 
    <div class="main-content">
        <div class="form-container mt-5"> <!-- mt-5: larger top margin -->
          <div class="card">
            <div class="card-body d-flex flex-column"> <!-- Makes card customizable -->
                <div class="user-form">
                    <form action="{{ route('add-user.store') }}" method="POST" class="needs-validation" novalidate>
                        @csrf <!-- CSRF Token for form security -->
                        <div class="form-row">
                          <div class="mb-3">
                            <label for="validationCustom01">First name</label>
                            <input type="text" class="form-control" id="validationCustom01" name="first_name" placeholder="First name" required>
                            <div class="valid-feedback">
                              Looks good!
                            </div>
                          </div>
                          <div class="mb-3">
                            <label for="validationCustom02">Last name</label>
                            <input type="text" class="form-control" id="validationCustom02" name="last_name" placeholder="Last name" required>
                            <div class="valid-feedback">
                              Looks good!
                            </div>
                          </div>
                          <div class="mb-3">
                            <label for="validationCustom03">Student ID</label>
                            <input type="text" class="form-control" id="validationCustom03" name="student_id" placeholder="ID" required>
                            <div class="invalid-feedback">
                              Please provide a valid ID.
                            </div>
                          </div>
                          <div class="mb-3">
                            <label for="validationCustom03">Phone Number</label>
                            <input type="text" class="form-control" id="validationCustom03" name="phone_number" placeholder="(xxx)xxx-xxxx" required>
                            <div class="invalid-feedback">
                              Please provide a valid number.
                            </div>
                          </div>
                          <div class="mb-3">
                            <label for="validationCustomUsername">Username</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupPrepend">@</span>
                              </div>
                              <input type="text" class="form-control" id="validationCustomUsername" name="username" placeholder="Username" aria-describedby="inputGroupPrepend" required>
                              <div class="invalid-feedback">
                                Please choose a username.
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="invalidCheck" name="agree_terms" required>
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
