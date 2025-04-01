@extends('layouts.app')

@section('content')
<div class="main-content">
    <div class="form-container mt-5">
      <div class="card">
        <div class="card-body d-flex flex-column">
            <div class="user-form">
                <form class="needs-validation" novalidate>
                    <div class="form-row">
                      <div class="mb-3">
                        <label for="firstName">First name</label>
                        <input type="text" class="form-control" id="firstName" placeholder="First name" required>
                      </div>
                      <div class="mb-3">
                        <label for="lastName">Last name</label>
                        <input type="text" class="form-control" id="lastName" placeholder="Last name" required>
                      </div>
                      <div class="mb-3">
                        <label for="studentID">Student ID</label>
                        <input type="text" class="form-control" id="studentID" placeholder="ID" required>
                      </div>
                      <div class="mb-3">
                        <label for="phoneNum">Phone Number</label>
                        <input type="text" class="form-control" id="phoneNum" placeholder="(xxx)xxx-xxxx" required>
                      </div>
                      <div class="mb-3">
                        <label for="username">Username</label>
                        <div class="input-group">
                          <span class="input-group-text" id="inputGroupPrepend">@</span>
                          <input type="text" class="form-control" id="username" placeholder="Username" aria-describedby="inputGroupPrepend" required>
                        </div>
                      </div>
                    </div>
                    <div class="form-group form-check">
                      <input class="form-check-input" type="checkbox" id="invalidCheck" required>
                      <label class="form-check-label" for="invalidCheck">Agree to terms and conditions</label>
                    </div>
                    <button class="btn btn-primary" type="submit">Submit form</button>
                  </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
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
}
.user-form {
    display:flex;
    width:100%;
    flex-direction:column;
    justify-content:center;
    align-items:center;    
}
.form-row {
    margin-top:10px;
    width:100%;
    color:#000;
}
.form-control {
    width: 360px;
}
</style>
@endpush
