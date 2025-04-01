<!DOCTYPE html>
<html lang="en">
<body>
    <div id="header"></div> 
    <div class="main-content">
        <div class="document-container mt-5b">
            <div class="card">
                <div class="top-buttons d-flex flex-row align-self-center">
                    <button id="back-btn" class="btn-back" href="/admin_user/users/patient_users" data-page="admin_user/users/patient_users">&lt; Go Back</button>
                    <button class="btn-edit">[Upload Document]</button>
                </div>
                <div class="card-body d-flex flex-column">
                    <div class="document-content">
                        <h1 class="card-title">Lab Results</h1>
                        <h2 class="table-title">Example List of Lab Results</h2>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Document Name</th>
                                    <th>Date Assigned</th>
                                    <th>Download Link</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    use Illuminate\Support\Facades\Storage;
                                    $json = Storage::get('public/patient_user/labData.json');
                                    $data = json_decode($json, true);
                                @endphp

                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $item['name'] ?? 'N/A' }}</td>
                                        <td>{{ $item['date'] ?? 'N/A' }}</td>
                                        <td>
                                            @if(isset($item['link']))
                                                <a href="{{ $item['link'] }}" target="_blank">Download</a>
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="button-container mt-5 d-flex flex-column">      
            <a class="record-btn btn-primary" href="/admin_user/users/patient_profile">Patient Profile</a>
            <a class="record-btn btn-primary" href="/admin_user/users/patient_measurements">Measurements</a>
            <a class="record-btn btn-primary" href="/admin_user/users/patient_documents">Documents</a>
            <a class="record-btn btn-primary" href="/admin_user/users/patient_labResults">Lab Results</a>
        </div>
    </div>
    <script src="/src/loadContent.js"></script>
    <script type="module" src="/src/main.js"></script>
</body>
<style>
    .main-content{
        margin-top:2rem;
        display:flex;
        justify-content:center;
        width: 100%;
        min-height:100vh;
    }
    .document-container{
        width:70%;
    }
    .card{
        background-color:#F2F2F2;
        height:100%;
        min-height:100vh;
    }
    .document-content{
        margin-left:1.5625rem;
        margin-right:1.5625rem;
    }
    .card-title{
        font-size:2rem;
        font-weight:500;
        text-align:left;
        margin-bottom:1.5625rem;
        margin-top:1.5625rem;
    }
    .table{
        margin-bottom:0px;
        --bs-table-bg:#F2F2F2;
        --bs-table-border-color:#000;
        align-items:center;
    }
    .td a{
        display:flex;
        align-items:center;
        justify-content:center;
        color:#000;
    }
    .table-title{
        font-size: 20px;
        margin-bottom:20px;
    }
    .button-container {
        width:13.375rem;
        height:17rem;
        display:flex;
        flex-direction: column;
        justify-content:space-between;
        margin-right:0.5rem;
        margin-left:0.5rem;
    }
    .record-btn {
        width:214px;
        height:60px;
        display:inline-flex;
        padding:18.5px 40px 18.5px 39px;
        justify-content:center;
        align-items:center;
        border-radius:8px;
        background:#6F1A34;
        box-shadow:0px 4px 4px 0px rgba(0, 0, 0, 0.25);
        color:#FFF;
        font-size:20px;
        font-weight:500;
    }
    .top-buttons {
        margin-top:0.625rem;
        margin-bottom:0.625rem;
        width:28.063;
        padding-top:0.625rem;
        display:flex;
        flex-direction:row;
    }
    .btn-back {
        position:absolute;
        left:1.875rem;
        font-size:1.25rem;
        font-weight:500;
        border:none;
        color:#000;
    }
    .btn-edit {
        position:absolute;
        right:1.875rem;
        border:none;
        color:#000;
        font-size:1.25rem;
        font-weight:500;
    }
</style>
</html>
