@extends('layouts.app')

@section('content')
<div class="page-content">
  <div class="login-container">
    <div class="card">
      <div class="card-body d-flex flex-column">
        <div class="login-content">
          <div class="logo">
            <div class="media">
              <img src="{{ asset('img/colimaGobiernoDelEstado.png') }}" alt="logo">
            </div>
          </div>
          <h1 class="card-title">Sign In</h1>
          <div class="login-form">
            <form method="POST" action="{{ route('login.submit') }}">
              @csrf
              <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Username">
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
              </div>
              <button type="submit" class="btn btn-primary">Sign In</button>
              <div class="signUp-container">
                <p>
                  Need an account?
                  <a href="{{ route('signup') }}">Create one here</a>
                </p>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
