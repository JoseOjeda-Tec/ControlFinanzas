<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control Gastos - Ingresos</title>

    <!-- Links of CSS -->
    <link rel="stylesheet" href="../../config/fontawesome/css/fontawesome.css"/>
    <link rel="stylesheet" href="../../config/fontawesome/css/brands.css"/>
    <link rel="stylesheet" href="../../config/fontawesome/css/solid.css"/>
    <link rel="stylesheet" href="../../config/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../config/css/style.css">
    <link rel="stylesheet" href="../../config/css/payments.css">

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
                    <button id="btn-menu-payments" type="button" class="menu-btn-dark menu-btn menu-btn-active"><i class="fa-solid fa-money-bill-1"></i> <p>Pagos</p></button>
                    <button id="btn-menu-parameters" type="button" class="menu-btn-dark menu-btn"><i class="fa-solid fa-gears"></i> <p>Parametros</p></button>
                </div>
            </div>

            <div class="container-body d-flex">

                <div class="side-bar-options mb-3 ml-3 mr-3 mt-0">
            
                        <div class="title-filtros-busqueda text-center p-3"><h6 class="m-0">Filtros de busqueda</h6></div>
                        <div class="form-filtro-ingresos d-flex align-items-center justify-content-center flex-column">
                            <input type="text" id="desc-flt" class="input-filtro-ingresos" placeholder="Descripción">
                            <select id="bank-flt" class="select-ingresos select-bank"></select>
                            <select id="meses-flt" class="select-ingresos select-month"></select>
                            <select id="anios-flt" class="select-ingresos select-anios"></select>
                            <button type="button" id="btn-filter-ing" class="ing-btn-side btn-dark-ing">Filtrar <i class="fa-solid fa-magnifying-glass"></i></button>
                            <button type="button" id="btn-clean-filter-ing" class="ing-btn-side btn-dark-ing">Limpiar <i class="fa-solid fa-broom"></i></button>
                        </div>
                
                </div>

                <div class="content-info-body mb-3 ml-0 mr-3 mt-0">

                    <div class="title-body-active d-flex justify-content-center text-center m-3">
                        <h1 id="title-body-id" class="title-body">Registro de Pagos</h1>
                    </div>
                
                    <div class="form-ingresos d-flex align-items-center justify-content-center mb-3 ml-0 mr-3 mt-3">
                        <input type="hidden" id="id-edit-ing">
                        <input type="text" id="descripcion-ing" placeholder="Descripción" class="input-ingresos">
                        <input type="number" min="1" pattern="^[0-9]+" id="monto-ing" placeholder="Monto Ingreso" class="input-ingresos">
                        <input type="date" id="fecha-ing" class="input-ingresos">
                        <select id="form-tipo-ing" class="select-form-ingresos select-form-tipo-ing"></select>
                        <select id="form-bank-ing" class="select-form-ingresos select-form-bank-ing"></select>
                        <select id="form-month-active-ing" class="select-form-ingresos select-form-month-active-ing"></select>
                    </div>
                    
                    <div class="form-ingresos-bottom d-flex align-items-center justify-content-center mb-3 ml-0 mr-3 mt-3">
                        <button type="button" id="btn-clean-ing" class="ing-btn btn-dark-ing">Limpiar <i class="fa-solid fa-broom"></i></button>
                        <button type="button" id="btn-save-ing" class="ing-btn btn-dark-ing">Guardar <i class="fa-solid fa-floppy-disk"></i></button>
                        <button type="button" id="btn-edit-ing" class="edit-ing-btn btn-dark-ing">Editar <i class="fa-solid fa-floppy-disk"></i></button>
                    </div>
                
                    <div class="listado-registro-ing"> </div>

                </div>

            </div>

        </div>
    </div>

</body>
<script src="../../config/js/general.js"></script>
<script src="../../config/js/payments.js"></script>
</html>