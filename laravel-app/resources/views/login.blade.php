<!DOCTYPE html>
<html lang="en">
<!-- Login Page -->
<body>
  <div class="page-content">
  @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
  @endif
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
            <!-- Display error message if login fails -->
            @if ($errors->has('login'))
              <div class="alert alert-danger">
                {{ $errors->first('login') }}
              </div>
            @endif
            <div class="login-form">
              <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="form-group">
                  <label for="username">Username</label>
                  <input type="text" class="form-control" id="username" name="username" aria-label="Username" placeholder="Username" required>
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" class="form-control" id="password" name="password" aria-label="Password" placeholder="Password" required>
                </div>
                <button type="submit" class="btn btn-primary">Sign In</button>
                <div class="signUp-container">
                  <p>
                    Need an account?
                    <a class="btn-signUp" href="{{ route('signup') }}">Create one here</a>
                  </p>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
<style>
  .page-content {
    background:#F9F9F9;
  }
  .login-container {
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
  }
  .card {
    width: fit-content;
    height: fit-content;
    flex-shrink: 0;
    border-radius: 0.875rem;
    border: 0.063rem solid rgba(0, 0, 0, 0.20);
    background: #FAFAFA;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 1.25rem;
  }
  /* Logo Styling */
  .logo{
    width:100%;
    display:flex;
    justify-content:center;
    align-items:center;
    margin-bottom: 1.25rem;
  }
  .logo img {
    margin: 0 auto;
    width: auto;
    max-width: 40%;
    height: auto;
  }
  .media {
    display:flex;
    justify-content:center;
    align-items:center;
  }
  /* ---------------------- */
  .login-content{
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
  }
  .card-title{
    text-align: center;
    color: #000;
    font-size: 2.25rem;
    font-style: normal;
    font-weight: 500;
    line-height: normal;
    margin-bottom: 0.625rem;
  }
  .login-form{
    display: flex;
    max-width: 21rem;
    width: 100%;
    flex-direction: column;
    justify-content: center;
    align-items: center;
  }
  .form-group{
    margin-top: 0.625rem;
    display: flex;
    width: 100%;
    flex-direction: column;
    color: #000;
    font-size: 1.25rem;
    font-style: normal;
    font-weight: 400;
    line-height: normal;
  }
  .form-control{
    border-radius: 0.5rem;
    border: 0.063rem solid #000;
    background: #FFF;
    width: 21rem;
    height: 3.75rem;
    margin-bottom: 10px;
    font-size: 1.25rem;
    font-style: normal;
    font-weight: 400;
    line-height: normal;
  }
  .btn{
    margin-top: 1.25rem;
    width: 21rem;
    height: 3.75rem;
    flex-shrink: 0;
    border-radius: 0.5rem;
    background: #6F1A34;
    --bs-btn-border-color: #6F1A34;
    --bs-btn-bg-color: #6F1A34;
    box-shadow: 0rem 0.25rem 0.25rem 0rem rgba(0, 0, 0, 0.25);
    color: #FFF;
    font-size: 1.25rem;
    font-style: normal;
    font-weight: 500;
    line-height: normal;
  }
  .btn:hover{
    background: #808080;
    --bs-btn-hover-border-color: #808080;
    --bs-btn-hover-bg-color: #808080;
    border-radius: 0.5rem;
    box-shadow: 0rem 0.25rem 0.25rem 0rem rgba(0, 0, 0, 0.25) inset;
  }
  .signUp-container {
    margin-top: 1rem;
    display: flex;
    flex-direction: column;
    align-items: center;
  }
</style>
</html>
