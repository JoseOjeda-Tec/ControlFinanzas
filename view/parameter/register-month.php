<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control Gastos - Parametros</title>

    <!-- Links of CSS -->
    <link rel="stylesheet" href="../../config/fontawesome/css/fontawesome.css"/>
    <link rel="stylesheet" href="../../config/fontawesome/css/brands.css"/>
    <link rel="stylesheet" href="../../config/fontawesome/css/solid.css"/>
    <link rel="stylesheet" href="../../config/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../config/css/style.css">
    <link rel="stylesheet" href="../../config/css/parameters.css">
    <link rel="stylesheet" href="../../config/css/register-month.css">

</head>
<body>
    
    <div class="container">
        <div class="container-descktop d-flex flex-column">

            <div class="menu-nav m-3">
                <div class="logo-menu">
                    <img src="../../config/img/logo.png" alt="">
                </div>
                <div class="menus">
                    <button id="btn-menu-home" type="button" class="menu-btn-dark menu-btn"><i class="fa-solid fa-house"></i> <p>Home</p></button>
                    <button id="btn-menu-income" type="button" class="menu-btn-dark menu-btn"><i class="fa-solid fa-money-bill-1"></i> <p>Ing/Egr</p></button>
                    <button id="btn-menu-payments" type="button" class="menu-btn-dark menu-btn"><i class="fa-solid fa-money-bill-1"></i> <p>Pagos</p></button>
                    <button id="btn-menu-parameters" type="button" class="menu-btn-dark menu-btn menu-btn-active"><i class="fa-solid fa-gears"></i> <p>Parametros</p></button>
                </div>
            </div>

            <div class="container-body d-flex">

                <div class="side-bar-options mb-3 ml-3 mr-3 mt-0">
            
                    <div class="title-filtros-busqueda text-center p-3"><h6 class="m-0">Formularios</h6></div>
                    <div class="list-forms">
                        <button type="button" id="btn-bank-form" class="form-btn-side btn-dark-ing">Bancos <i class="fa-solid fa-piggy-bank"></i></button>
                        <button type="button" id="btn-mont-form" class="form-btn-side btn-dark-ing form-btn-active">Mes Activo <i class="fa-regular fa-calendar"></i></button>
                        <button type="button" id="btn-logs-form" class="form-btn-side btn-dark-ing">Logs <i class="fa-solid fa-timeline"></i></button>
                        <button type="button" id="btn-user-form" class="form-btn-side btn-dark-ing">Usuarios <i class="fa-solid fa-users"></i></button>
                    </div>
                
                </div>

                <div class="content-info-body mb-3 ml-0 mr-3 mt-0">

                    <div class="title-body-active d-flex justify-content-center text-center m-3">
                        <h1 id="title-body-id" class="title-body">Mes/Año Activo</h1>
                    </div>

                    <div class="listado-registro-parameters active-month-panel"> </div>
                    <div class="listado-registro-parameters active-year-panel"> </div>

                </div>

            </div>

        </div>
    </div>

</body>
<script src="../../config/js/general.js"></script>
<script src="../../config/js/register-month.js"></script>
</html>