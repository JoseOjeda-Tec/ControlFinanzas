<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control Gastos - Dashboard</title>

    <!-- Links of CSS -->
    <link rel="stylesheet" href="../../config/fontawesome/css/fontawesome.css"/>
    <link rel="stylesheet" href="../../config/fontawesome/css/brands.css"/>
    <link rel="stylesheet" href="../../config/fontawesome/css/solid.css"/>
    <link rel="stylesheet" href="../../config/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../config/css/style.css">
    <link rel="stylesheet" href="../../config/css/dashboard.css">

</head>
<body>
    
    <div class="container">
        <div class="container-descktop d-flex flex-column">

            <div class="menu-nav m-3">
                <div class="logo-menu">
                    <img src="../../config/img/logo.png" alt="">
                </div>
                <div class="menus">
                <button id="btn-menu-home" type="button" class="menu-btn-dark menu-btn menu-btn-active"><i class="fa-solid fa-house"></i> <p>Home</p></button>
                <button id="btn-menu-income" type="button" class="menu-btn-dark menu-btn"><i class="fa-solid fa-money-bill-1"></i> <p>Ing/Egr</p></button>
                    <button id="btn-menu-parameters" type="button" class="menu-btn-dark menu-btn"><i class="fa-solid fa-gears"></i> <p>Parametros</p></button>
                </div>
            </div>

            <div class="container-body d-flex">

                <div class="content-info-body mb-3 ml-0 mr-3 mt-0">

                    <div class="summarys">
                        <div class="summary-card summary-income">
                            <a href="#" class="value-summary value-income" id="id-income"></a> <i class="fa-solid fa-arrow-up value-income"></i>
                            <p class="desc-summary desc-income">Ingresos</p>
                        </div>
                        <div class="summary-card summary-expenses">
                            <a href="#" class="value-summary value-expenses" id="id-expenses"></a> <i class="fa-solid fa-arrow-down value-expenses"></i>
                            <p class="desc-summary desc-expenses">Egresos</p>
                        </div>
                        <div class="summary-card summary-rest">
                            <a href="#" class="value-summary value-rest" id="id-rest"></a> <i class="fa-solid fa-wallet value-rest"></i>
                            <p class="desc-summary desc-rest">Resto</p>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>

</body>
<script src="../../config/js/general.js"></script>
<script src="../../config/js/dashboard.js"></script>
</html>