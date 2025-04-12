<!DOCTYPE html>
<html lang="en">
<body>
    <div class="register-container">
        <h1>Create an Account</h1>

        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>

            <button type="submit">Register</button>
        </form>
    </div>
</body>
</html>
