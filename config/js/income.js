window.onload = function() {
    asignaFuncionBotonesPrincipales();
    desactivaBotonEdicion();
    cargaSelects();
    asignaFuncionBotones();
    restartDefault();
    getIncomes(getBankAcive()[0]['id_bank'], getYearActive()[0]['id_year_active']);
}

function formatMoney(nunero){
    let money = new Intl.NumberFormat('de-DE').format(nunero);
    return money;
}

function desactivaBotonEdicion(charge = 0){

    const btnedit = document.querySelector(".edit-ing-btn");
    const btnsave = document.querySelector("#btn-save-ing");

    if (charge == 0) {
        btnedit.style = "display: none;";
        btnsave.style = "display: block;";
    } else {
        btnedit.style = "display: block;";
        btnsave.style = "display: none;";
    }

}

function cargaSelects(){

    const mesActual = getMonthActive()[0]['id_month_active'];
    const anioActual = getYearActive()[0]['id_year_active'];

    cargaSelectBanco("#form-bank-ing");
    cargaTipoCuentaSelect("#form-tipo-ing");
    cargaMesesSelect("#form-month-active-ing", mesActual);
    cargaAniosSelect("#form-year-active-ing", anioActual);

}

function asignaFuncionBotones(){

    const btnedit = document.querySelector(".edit-ing-btn");
    const btnsave = document.querySelector("#btn-save-ing");
    const btnclean = document.querySelector("#btn-clean-ing");
    const btnfltr = document.querySelector("#btn-filter-ing");
    const btncleanfltr = document.querySelector("#btn-clean-filter-ing");

    btnsave.addEventListener("click", ()=>{ setIncomes(); });
    btnedit.addEventListener("click", ()=>{ updateIncomes(); });
    btnclean.addEventListener("click", ()=>{ limpiarCampos(); });
    btnfltr.addEventListener("click", ()=>{ getIncomes(); });
    btncleanfltr.addEventListener("click", ()=>{ restartDefault(); });

}

function limpiarCampos(){

    const desc = document.querySelector("#descripcion-ing");
    const monto = document.querySelector("#monto-ing");
    const btnedit = document.querySelector(".edit-ing-btn");
    const btnsave = document.querySelector("#btn-save-ing");
    const fecha_ing = document.querySelector("#fecha-ing");
    const mesActual = getMonthActive()[0]['id_month_active'];
    const anioActual = getYearActive()[0]['id_year_active'];

    cargaSelectBanco("#form-bank-ing");
    cargaTipoCuentaSelect("#form-tipo-ing");
    cargaMesesSelect("#form-month-active-ing", mesActual);
    cargaAniosSelect("#form-year-active-ing", anioActual);

    desc.value = "";
    monto.value = "";
    fecha_ing.value = "";
    btnsave.style = "display: block;";
    btnedit.style = "display: none;";

}

function restartDefault(){

    var fullyear = getYearActive()[0]['id_year_active'];
    var mesActual = getMonthActive()[0]['id_month_active'];

    const desc = document.querySelector("#desc-flt");

    cargaAniosSelect("#anios-flt", fullyear);
    cargaMesesSelect("#meses-flt", mesActual);
    cargaSelectBanco("#bank-flt");

    desc.value = "";

}

function getIncomes(id_bank = 0, id_year_active = 0){

    const desc = document.querySelector("#desc-flt");
    const slcbank = document.querySelector("#bank-flt");
    const slcmes = document.querySelector("#meses-flt");
    const slcanio = document.querySelector("#anios-flt");

    var parametros = {
        accion: 'getIncomesFilter',
        'desc' : desc.value,
        'id_bank' : id_bank == 0 ? slcbank.value : id_bank,
        'mes' : slcmes.value,
        'anio' : id_year_active == 0 ? slcanio.value : id_year_active
    };

    ajax(
        'POST', 
        '../../controller/income-controller.php', 
        (xhr) => {
            var response = JSON.parse(xhr.responseText);
            var html = "";
            var classData = "";
            var classMonto = "";
            var total_ing_input = 0;
            var total_egr_input = 0;
            var total_rest_input = 0;
            var mensaje = "";

            if(Object.entries(response).length == 0){
                html += "<div class=\"data-info\">";
                    html += "<div class=\"info-item\"><h5>No hay registros</h5></div>";
                html += "</div>";
            }else{
                response.forEach(element => {

                    classData = element['type_trans'] == 'INCOME' ? "data-info" : "data-info-exp";
                    classMonto = element['type_trans'] == 'INCOME' ? "monto-ing" : "monto-ing-exp";

                    html += "<div class=\"" + classData + "\">";
                        html += "<div class=\"desc-ing\"><p id=\"data-desc\">" + element["descripcion"] + "</p></div>";
                        html += "<div class=\"" + classMonto + "\"><p id=\"data-monto\">$" + formatMoney(element["monto"]) + "</p></div>";
                        html += "<div class=\"bank-ing\"><p id=\"data-bank\">" + element["desc_bank"] + "/" + element["desc_type"] + "</p></div>";
                        html += "<div class=\"dias-ing\"><p id=\"data-fecha-ing\">" + element["fecha_ing"] + "</p></div>";
                        html += "<div class=\"opc-ing\">";
                            html += "<button type=\"button\" class=\"edit-btn btn-opc-item\" onclick=\"getIncome(" + element["id_income"] + ")\"><i class=\"fa-solid fa-pen\"></i></button>";
                            html += "<button type=\"button\" class=\"delete-btn btn-opc-item\" onclick=\"deleteIncome(" + element["id_income"] + ")\"><i class=\"fa-solid fa-xmark\"></i></button>";
                        html += "</div>";
                    html += "</div>";

                    if(element['type_trans'] == 'INCOME'){ total_ing_input = total_ing_input + (element["monto"] * 1); }
                    if(element['type_trans'] == 'EXPENSES'){ total_egr_input = total_egr_input + (element["monto"] * 1); }
                    total_rest_input = total_ing_input - total_egr_input;

                    mensaje = total_rest_input < 0 ? "<p>El valor esta en numeros negativos : " + total_rest_input + "</p>" : "";

                    total_rest_input = total_rest_input < 1 ? 0 : total_rest_input;
                    
                });
            }
            
            const cnting = document.querySelector(".listado-registro-ing");
            const ttling = document.querySelector("#total-ing");
            const ttlegr = document.querySelector("#total-egr");
            const ttlrest = document.querySelector("#total-rest");
            const msjinput = document.querySelector(".mensaje"); 
            cnting.innerHTML = "";
            cnting.innerHTML = html;
            ttling.value = "$" + formatMoney(total_ing_input);
            ttlegr.value = "$" + formatMoney(total_egr_input);
            ttlrest.value = "$" + formatMoney(total_rest_input);
            msjinput.innerHTML = mensaje;
        }, 
        parametros
    );

}

function getIncome(id_income){

    ajax(
        'POST', 
        '../../controller/income-controller.php', 
        (xhr) => {
            var response = JSON.parse(xhr.responseText);
            response.forEach(element => {
                const id_income_hidde = document.querySelector("#id-edit-ing");
                const desc = document.querySelector("#descripcion-ing");
                const monto = document.querySelector("#monto-ing");
                const fecha_ing = document.querySelector("#fecha-ing");
                cargaSelectBanco("#form-bank-ing", element["id_bank"]);
                cargaMesesSelect("#form-month-active-ing", element["id_month_active"]);
                cargaAniosSelect("#form-year-active-ing", element["id_year_active"]);
                cargaTipoCuentaSelect("#form-tipo-ing", element["type_trans"]);

                desc.value = element["descripcion"];
                monto.value = element["monto"];
                fecha_ing.value = element["fecha_ing"];
                id_income_hidde.value = id_income;
                desactivaBotonEdicion(1);
            });
        }, 
        { 'accion' : 'getIncome', 'id_income' : id_income } 
    );

}

function setIncomes(){

    let boolData = true;
    const desc = document.querySelector("#descripcion-ing");
    const monto = document.querySelector("#monto-ing");
    const fecha_ing = document.querySelector("#fecha-ing");
    const slctipo = document.querySelector("#form-tipo-ing");
    const slcbank = document.querySelector("#form-bank-ing");
    const slcmonth = document.querySelector("#form-month-active-ing");
    const slcyear = document.querySelector("#form-year-active-ing");

    boolData = desc.value == "" ? false : true;
    if(boolData == false){ alert('Debe escribir la descripcion del ingreso'); return; }

    boolData = monto.value == "" ? false : true;
    if(boolData == false){ alert('Debe escribir el monto de ingreso'); return; }

    boolData = fecha_ing.value == "" ? false : true;
    if(boolData == false){ alert('Debe seleccionar una fecha de ingreso'); return; }
    
    boolData = slcbank.value == 0 ? false : true;
    if(boolData == false){ alert('Debe seleccionar un banco'); return; }

    if(boolData){
        var parametros = {
            'accion' : 'setIncomes',
            'desc' : desc.value,
            'monto' : monto.value,
            'fecha_ing' : fecha_ing.value,
            'tipo' : slctipo.value,
            'id_bank' : slcbank.value,
            'id_month_active' : slcmonth.value,
            'id_year_active' : slcyear.value
        };
    
        ajax(
            'POST', 
            '../../controller/income-controller.php', 
            (xhr) => {
                var response = JSON.parse(xhr.responseText);
                if(response["respuesta"] == 1){
                    console.log(response["mensaje"]);
                    limpiarCampos();
                    getIncomes();
                }
            }, 
            parametros 
        );
    }

}

function updateIncomes(){

    let boolData = true;
    const id_income_hidde = document.querySelector("#id-edit-ing");
    const desc = document.querySelector("#descripcion-ing");
    const monto = document.querySelector("#monto-ing");
    const fecha_ing = document.querySelector("#fecha-ing");
    const slctipo = document.querySelector("#form-tipo-ing");
    const slcbank = document.querySelector("#form-bank-ing");
    const slcmonth = document.querySelector("#form-month-active-ing");
    const slcyear = document.querySelector("#form-year-active-ing");

    boolData = desc.value == "" ? false : true;
    if(boolData == false){ alert('Debe escribir la descripcion del ingreso'); return; }

    boolData = monto.value == "" ? false : true;
    if(boolData == false){ alert('Debe escribir el monto de ingreso'); return; }

    boolData = fecha_ing.value == "" ? false : true;
    if(boolData == false){ alert('Debe seleccionar una fecha de ingreso'); return; }
    
    boolData = slcbank.value == 0 ? false : true;
    if(boolData == false){ alert('Debe seleccionar un banco'); return; }

    if(boolData){
        var parametros = {
            'accion' : 'updateIncomes',
            'id_income' : id_income_hidde.value,
            'desc' : desc.value,
            'monto' : monto.value,
            'fecha_ing' : fecha_ing.value,
            'tipo' : slctipo.value,
            'id_bank' : slcbank.value,
            'id_month_active' : slcmonth.value,
            'id_year_active' : slcyear.value
        };
    
        ajax(
            'POST', 
            '../../controller/income-controller.php', 
            (xhr) => {
                var response = JSON.parse(xhr.responseText);
                if(response["respuesta"] == 1){
                    console.log(response["mensaje"]);
                    limpiarCampos();
                    getIncomes();
                }
            }, 
            parametros 
        );
    }

}

function deleteIncome(id_income){

    var parametros = {
        'accion' : 'deleteIncome',
        'id_income' : id_income
    };

    ajax(
        'POST', 
        '../../controller/income-controller.php', 
        (xhr) => {
            var response = JSON.parse(xhr.responseText);
            if(response["respuesta"] == 1){
                console.log(response["mensaje"]);
                limpiarCampos();
                getIncomes();
            }
        }, 
        parametros 
    );

}