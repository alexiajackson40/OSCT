<!DOCTYPE html>
<html lang="en">
<!-- Patient Home Page-->
<head>
     <!-- Import Bootstrap and Custom Styles -->
     <link href="{{ asset('theme.css') }}" rel="stylesheet">
     <link href="{{ asset('style.css') }}" rel="stylesheet">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
</head>
<body>
    <!-- Page Header -->
   @include('patient_user.header_patient')
    <div class="main-content">
        <div class="home-container mt-5">
            <div class="card">
                <div class="card-body d-flex flex-column align-items-center">
                    <div class="media mb-3">
                        <img src="{{ asset('img/colimaGobiernoDelEstado.png') }}" alt="logo" width="225" height="200">
                    </div>
                    <div class="card-text">
                    <p class="card-text">Operación Salud Colima Tamizaje, es una estrategia implementada por el Gobierno del Estado, a través de la Secretaría de Salud, con el objetivo de respaldar el derecho a la salud en México, lo anterior, con fundamento en el cumplimiento del artículo 4º de la Constitución, el cual estipula que “toda persona tiene derecho a la protección de la salud”.</p>
                    <p class="card-text">Operación Salud Colima Tamizaje se enfoca en realizar una detección oportuna de las alteraciones nutrimentales y de salud que pudieran presentar niñas, niños y adolescentes que reciben educación básica en el sector público, para que de manera posterior en quienes así lo requiera, se refieran de manera oportuna y eficaz a las Instituciones prestadoras de Servicios de Salud en la Entidad.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<style>
    /* Styling for Containers*/
    .main-content {
        display: flex;
        justify-content: center;
        width: 100%;
        min-height: 100vh;
        background-color: var(--light-surface-one);
    }
    .home-container {
        width: 70%;
    }
    .card {
        background-color: #FAFAFA;
        padding: 1.5rem;
    }
    /*-----------------------------------*/
    /* Styling Text*/
    p {
        font-weight: 600;
        font-size: 20px;
        margin-top: 0.5rem;
        text-align: center;
    }
    /*-----------------------------------*/
</style>
</html>
