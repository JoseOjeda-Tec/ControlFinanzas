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
                    <button id="btn-menu-parameters" type="button" class="menu-btn-dark menu-btn menu-btn-active"><i class="fa-solid fa-gears"></i> <p>Parametros</p></button>
                </div>
            </div>

            <div class="container-body d-flex">

                <div class="side-bar-options mb-3 ml-3 mr-3 mt-0">
            
                    <div class="title-filtros-busqueda text-center p-3"><h6 class="m-0">Formularios</h6></div>
                    <div class="list-forms">
                        <button type="button" id="btn-bank-form" class="form-btn-side btn-dark-ing form-btn-active">Bancos <i class="fa-solid fa-piggy-bank"></i></button>
                        <!-- <button type="button" id="btn-user-form" class="form-btn-side btn-dark-ing">Usuarios <i class="fa-solid fa-users"></i></button> -->
                    </div>
                
                </div>

                <div class="content-info-body mb-3 ml-0 mr-3 mt-0">

                    <div class="title-body-active d-flex justify-content-center text-center m-3">
                        <h1 id="title-body-id" class="title-body">Registro de bancos</h1>
                    </div>

                    <div class="form-parametros form-bank-parameters d-flex align-items-center justify-content-center mb-3 ml-0 mr-3 mt-3">
                        <input type="hidden" id="id-edit-bank">
                        <input type="text" id="descripcion" placeholder="Descripción" class="input-bank">
                        <input type="text" id="tipo-cuenta" placeholder="Tipo cuenta" class="input-bank">
                    </div>
                    
                    <div class="form-parametros-bottom d-flex align-items-center justify-content-center mb-3 ml-0 mr-3 mt-3">
                        <button type="button" id="btn-clean" class="parameters-btn btn-dark-ing">Limpiar <i class="fa-solid fa-broom"></i></button>
                        <button type="button" id="btn-save" class="parameters-btn btn-dark-ing">Guardar <i class="fa-solid fa-floppy-disk"></i></button>
                        <button type="button" id="btn-edit" class="edit-parameters-btn btn-dark-ing">Editar <i class="fa-solid fa-floppy-disk"></i></button>
                    </div>

                    <div class="listado-registro-parameters"> </div>

                </div>

            </div>

        </div>
    </div>

</body>
<script src="../../config/js/general.js"></script>
<script src="../../config/js/register-bank.js"></script>
</html>