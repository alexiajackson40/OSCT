<!DOCTYPE html>
<html lang="en">
<!-- Home Page -->
<body>
    <div id="header"></div> 
    <div class="main-content">
        <div class="home-container">
            <div class="card">
                <div class="card-body d-flex flex-column align-items-center">
                    <!-- Content Text -->
                    <p class="card-text">This page needs to go. Site Opens directly to log in page</p>
                    <!-- Button for login redirect (placed at the top right) -->
                    <a href="{{ route('login') }}" class="btn btn-primary mt-3">Login</a>
                </div>
            </div>
        </div>
    </div>
    <div class="logo-container">
        <img src="{{ asset('img/colimaGobiernoDelEstado.png') }}" alt="logo" width="225" height="200">
    </div>
</body>
<style>
    .main-content {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        min-height: 100vh;
        position: relative;
    }
    .home-container {
        width: 70%;
        text-align: center;
    }
    .card-title {
        font-size: 30px;
    }
    p {
        font-weight: 500;
    }
    .logo-container {
        position: absolute;
        top: 15%;
        left: 50%;
        transform: translate(-50%, -50%); 
        z-index: 10;
    }
    .btn {
        position: absolute;
        top: 20px;
        right: 20px;
        width: 200px;
        height: 45px;
        display: inline-flex;
        justify-content: center;
        align-items: center;
        font-size: 16px;
        font-weight: 500;
        border-radius: 8px;
        background: #6F1A34;
        color: #FFF;
        text-decoration: none;
    }
    .btn:hover {
        background-color: #5a142a;
    }
</style>
<script src="{{ asset('js/loadContent.js') }}"></script>
<script type="module" src="{{ asset('js/main.js') }}"></script>
</html>
