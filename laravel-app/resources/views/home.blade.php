<!DOCTYPE html>
<html lang="en">
<!-- Home Page -->
<body>
    <div id="header"></div> 
    <div class="main-content">
        <!-- Centered content -->
        <div class="home-container">
            <div class="card">
                <div class="card-body d-flex flex-column align-items-center">
                    <!-- Content Text -->
                    <p class="card-text">Lorem ipsum dolor sit amet. 33 itaque laborum At labore ratione et autem exercitationem id veritatis dolorem sit maxime architecto qui beatae ratione. Et amet laborum qui nulla tempora vel impedit cupiditate est voluptatum adipisci et facilis quia sit optio unde.</p>
                    <p class="card-text">Vel laudantium facilis ut dolorem molestias ut galisum cupiditate eos earum voluptas ut fuga assumenda. Eos quos debitis et voluptatem galisum est distinctio impedit a facere sunt ut vitae saepe aut nihil architecto ea aspernatur labore. Eum libero facere est eius eaque At velit quam vel facilis amet et officiis quis aut sunt sunt aut commodi optio.</p>
                    <p class="card-text">Est omnis aperiam sit doloribus atque At accusantium sint et esse assumenda quo exercitationem quaerat in consectetur totam. Est nostrum blanditiis At nisi nobis et consequatur minima aut voluptas molestiae et tempora obcaecati sit voluptatibus vero. Aut odio cumque qui impedit voluptatem ut consectetur tempora hic internos exercitationem. Vel quam placeat et pariatur dolor id ipsum quasi At velit numquam et quos quidem est alias obcaecati.</p>
                    
                    <!-- Button for login redirect (placed at the top right) -->
                    <a href="{{ route('login') }}" class="btn btn-primary mt-3">Login</a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Logo moved to the center of the screen -->
    <div class="logo-container">
        <img src="{{ asset('img/colimaGobiernoDelEstado.png') }}" alt="logo" width="225" height="200">
    </div>
</body>

<style>
    /* Center the content vertically and horizontally */
    .main-content {
        display: flex;
        justify-content: center;
        align-items: center;  /* Center vertically */
        width: 100%;
        min-height: 100vh;
        position: relative;
    }

    /* Content container (the text and card) */
    .home-container {
        width: 70%;
        text-align: center; /* Ensure text and button align center */
    }

    .card-title {
        font-size: 30px;
    }

    p {
        font-weight: 500;
    }

    .logo-container {
        position: absolute;
        top: 15%; /* Vertically center the logo */
        left: 50%; /* Horizontally center the logo */
        transform: translate(-50%, -50%); /* Correct offset to truly center */
        z-index: 10; /* Ensure the logo stays on top of other elements */
    }

    /* Button Positioning (Top Right) */
    .btn {
        position: absolute;
        top: 20px; /* Adjust as necessary */
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
