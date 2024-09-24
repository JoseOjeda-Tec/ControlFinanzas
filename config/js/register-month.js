window.onload = function() {
    asignaFuncionBotonesPrincipales();
    asignaFuncionBotonesParametros();
    cargaMonthsActive();
    cargaYearsActive();
}

function cargaMonthsActive(){

    var parametros = { accion: 'getMonthsActive' };

    ajax(
        'POST', 
        '../../controller/month-active-controller.php', 
        (xhr) => {
            var response = JSON.parse(xhr.responseText);
            var html = "";
            var classData = "";
            var classchk = "";
            var faicon = "";
            var cont = 0;

            if(Object.entries(response).length == 0){
                html += "<div class=\"data-info\">";
                    html += "<div class=\"info-item\"><h5>No hay meses registrados</h5></div>";
                html += "</div>";
            }else{
                response.forEach(element => {

                    classData = element['active'] == 1 ? "data-info-exp" : "data-info";
                    classchk = element['active'] == 1 ? "delete-btn" : "edit-btn";
                    faicon = element['active'] == 1 ? "<i class=\"fa-regular fa-thumbs-down\"></i>" : "<i class=\"fa-regular fa-thumbs-up\"></i>";


                    html += cont == 0 ? "<div class=\"data-info-panel\">" : "";

                    html += "<div class=\"" + classData + "\">";
                        html += "<div class=\"desc-ing\"><p id=\"data-desc\">" + element["descripcion"] + "</p></div>";
                        html += "<div class=\"opc-ing\">";
                            html += "<button type=\"button\" class=\"" + classchk + " btn-opc-item\" onclick=\"updateMonthActive(" + element["id_month_active"] + ")\">" + faicon + "</button>";
                        html += "</div>";
                    html += "</div>";

                    html += cont == 2 ? "</div>" : "";
                    cont = cont == 2 ? 0 : cont + 1;

                });
            }
            
            const cnting = document.querySelector(".active-month-panel");
            cnting.innerHTML = "";
            cnting.innerHTML = html;
        }, 
        parametros
    );

}

function cargaYearsActive(){

    var parametros = { accion: 'getYearsActive' };

    ajax(
        'POST', 
        '../../controller/year-active-controller.php', 
        (xhr) => {
            var response = JSON.parse(xhr.responseText);
            var html = "";
            var classData = "";
            var classchk = "";
            var faicon = "";
            var cont = 0;

            if(Object.entries(response).length == 0){
                html += "<div class=\"data-info\">";
                    html += "<div class=\"info-item\"><h5>No hay años registrados</h5></div>";
                html += "</div>";
            }else{
                response.forEach(element => {

                    classData = element['active'] == 1 ? "data-info-exp" : "data-info";
                    classchk = element['active'] == 1 ? "delete-btn" : "edit-btn";
                    faicon = element['active'] == 1 ? "<i class=\"fa-regular fa-thumbs-down\"></i>" : "<i class=\"fa-regular fa-thumbs-up\"></i>";


                    html += cont == 0 ? "<div class=\"data-info-panel\">" : "";

                    html += "<div class=\"" + classData + "\">";
                        html += "<div class=\"desc-ing\"><p id=\"data-desc\">" + element["anio"] + "</p></div>";
                        html += "<div class=\"opc-ing\">";
                            html += "<button type=\"button\" class=\"" + classchk + " btn-opc-item\" onclick=\"updateYearActive(" + element["id_year_active"] + ")\">" + faicon + "</button>";
                        html += "</div>";
                    html += "</div>";

                    html += cont == 2 ? "</div>" : "";
                    cont = cont == 2 ? 0 : cont + 1;

                });
            }
            
            const cnting = document.querySelector(".active-year-panel");
            cnting.innerHTML = "";
            cnting.innerHTML = html;
        }, 
        parametros
    );

}

function updateMonthActive(id_month_active){

    var parametros = {
        'accion' : 'updateMonthActive',
        'id_month_active' : id_month_active
    };

    ajax(
        'POST', 
        '../../controller/month-active-controller.php', 
        (xhr) => {
            var response = JSON.parse(xhr.responseText);
            if(response["respuesta"] == 1){
                console.log(response["mensaje"]);
                cargaMonthsActive();
            }
        }, 
        parametros 
    );

}

function updateYearActive(id_year_active){

    var parametros = {
        'accion' : 'updateYearActive',
        'id_year_active' : id_year_active
    };

    ajax(
        'POST', 
        '../../controller/year-active-controller.php', 
        (xhr) => {
            var response = JSON.parse(xhr.responseText);
            if(response["respuesta"] == 1){
                console.log(response["mensaje"]);
                cargaYearsActive();
            }
        }, 
        parametros 
    );

}