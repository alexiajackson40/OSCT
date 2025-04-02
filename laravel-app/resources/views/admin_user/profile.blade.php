<!DOCTYPE html>
<html lang="en">
<!-- Admin User Profile Page -->
<body>
    <div id="header"></div> 
    <div class="main-content">
        <div class="profile-container mt-5">
            <div class="card">
                <!-- Button for editing profile -->
                <button class="btn-page btn-primary" onclick="window.location='{{ route('edit.profile') }}'">[Edit Information]</button>
                <div class="card-body d-flex flex-column align-self-center">
                    <h1 class="card-title">{{ $user->first_name }} {{ $user->last_name }}</h1>
                    <div class="information-container d-flex flex-column align-items-left">
                        <h2 class="container-header">User Information</h2>
                        <table id="Table" class="table">
                            <tr>
                                <td>Username</td>
                                <td>{{ $user->username }}</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>{{ $user->email }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="contact-container d-flex flex-column align-items-left">
                        <h2 class="container-header">Contact Information</h2>
                        <table id="Table" class="table">
                            <tr>
                                <td>Phone</td>
                                <td>{{ $user->phone }}</td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td>{{ $user->address }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/loadContent.js') }}"></script>
    <script type="module" src="{{ asset('js/main.js') }}"></script>
</body>

<style>
    .main-content {
        display: flex;
        justify-content: center;
        width: 100%;
        min-height: 100vh;
    }
    .profile-container {
        width: 70%;
        display: flex;
        justify-content: center;
    }
    .card {
        background-color: #F2F2F2;
        width: 545px;
        height: 700px;
        position: relative;
    }
    .card-body {
        padding-top: 10px;
        display: flex;
        flex-direction: column;
    }
    .card-title {
        font-size: 32px;
        font-weight: 500;
        margin-top: 40px;
    }
    .container-header {
        font-size: 20px;
        font-weight: 500;
        padding-left: 14px;
        padding-top: 14px;
    }
    .information-container,
    .contact-container {
        margin-top: 15px;
        width: 449px;
        height: auto;
        border-radius: 6px;
        border: 1px solid rgba(0, 0, 0, 0.30);
        background: #FFF;
    }
    .table {
        margin-left: 14px;
        color: #000000;
        font-size: 16px;
        font-weight: 400;
        width: auto;
    }
    .btn-page {
        position: absolute;
        right: 4px;
        width: 214px;
        height: 60px;
        border: none;
        color: #000;
        background: #F2F2F2;
        font-size: 20px;
        font-weight: 500;
        text-decoration-line: underline;
    }
</style>
</html>
