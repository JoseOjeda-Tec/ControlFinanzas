function asignaFuncionBotonesPrincipales(){
    const btnhome = document.querySelector("#btn-menu-home");
    const btnincome = document.querySelector("#btn-menu-income");
    const btnpayments = document.querySelector("#btn-menu-payments");
    const btnparameters = document.querySelector("#btn-menu-parameters");    

    btnhome.addEventListener("click", ()=>{ location.href ="../../view/dashboard/dashboard.php"; });
    btnincome.addEventListener("click", ()=>{ location.href ="../../view/income/income.php"; });
    btnpayments.addEventListener("click", ()=>{ location.href ="../../view/payments/payments.php"; });
    btnparameters.addEventListener("click", ()=>{ location.href ="../../view/parameter/register-bank.php"; });
}

function asignaFuncionBotonesParametros(){

    const btnbank = document.querySelector("#btn-bank-form"); 
    const btnmont = document.querySelector("#btn-mont-form"); 
    const btnlogs = document.querySelector("#btn-logs-form"); 
    const btnuser = document.querySelector("#btn-user-form");

    btnbank.addEventListener("click", ()=>{ location.href ="../../view/parameter/register-bank.php"; });
    btnmont.addEventListener("click", ()=>{ location.href ="../../view/parameter/register-month.php"; });
    btnlogs.addEventListener("click", ()=>{ location.href ="../../view/parameter/register-logs.php"; });
    btnuser.addEventListener("click", ()=>{ location.href ="../../view/parameter/register-user.php"; });

}

function getMonthActive(){
    
    let dataReturn = ajaxReturn(
        'POST', 
        '../../controller/month-active-controller.php', 
        (xhr) => {
            var response = JSON.parse(xhr.responseText);
            return response;
        }, 
        { accion: 'getMonthActive' }
    );

    return dataReturn;

}

function getYearActive(){
    
    let dataReturn = ajaxReturn(
        'POST', 
        '../../controller/year-active-controller.php', 
        (xhr) => {
            var response = JSON.parse(xhr.responseText);
            return response;
        }, 
        { accion: 'getYearActive' }
    );

    return dataReturn;

}

function getBankAcive(){
    
    let dataReturn = ajaxReturn(
        'POST', 
        '../../controller/bank-controller.php', 
        (xhr) => {
            var response = JSON.parse(xhr.responseText);
            return response;
        }, 
        { accion: 'getBankAcive' }
    );

    return dataReturn;

}

function cargaMesesSelect(className, messelect = 0){

    var html = "";
    
    // html += "<option value=\"0\" " + (0 == messelect ? " selected" : "") + ">Mes</option>";
    html += "<option value=\"1\" " + (1 == messelect ? " selected" : "") + ">Enero</option>";
    html += "<option value=\"2\" " + (2 == messelect ? " selected" : "") + ">Febrero</option>";
    html += "<option value=\"3\" " + (3 == messelect ? " selected" : "") + ">Marzo</option>";
    html += "<option value=\"4\" " + (4 == messelect ? " selected" : "") + ">Abril</option>";
    html += "<option value=\"5\" " + (5 == messelect ? " selected" : "") + ">Mayo</option>";
    html += "<option value=\"6\" " + (6 == messelect ? " selected" : "") + ">Junio</option>";
    html += "<option value=\"7\" " + (7 == messelect ? " selected" : "") + ">Julio</option>";
    html += "<option value=\"8\" " + (8 == messelect ? " selected" : "") + ">Agosto</option>";
    html += "<option value=\"9\" " + (9 == messelect ? " selected" : "") + ">Septiembre</option>";
    html += "<option value=\"10\" " + (10 == messelect ? " selected" : "") + ">Octubre</option>";
    html += "<option value=\"11\" " + (11 == messelect ? " selected" : "") + ">Noviembre</option>";
    html += "<option value=\"12\" " + (12 == messelect ? " selected" : "") + ">Diciembre</option>";

    const slc = document.querySelector(className);
    slc.innerHTML = html;

}

function cargaAniosSelect(className, anioselect = 0){

    ajax(
        'POST', 
        '../../controller/year-active-controller.php', 
        (xhr) => {
            var response = JSON.parse(xhr.responseText);
            var html = "";

            if(Object.entries(response).length == 0){
                html += "";
            }else{
                html += "";
                response.forEach(element => { 
                    html += "<option value=\"" + element["id_year_active"] + "\"" + (element["id_year_active"] == anioselect || element["anio"] == anioselect ? " selected" : "") + ">" + element["anio"] + "</option>";
                });
            }
            
            const sldyear = document.querySelector(className);
            sldyear.innerHTML = "";
            sldyear.innerHTML = html;
        }, 
        { accion: 'getYearsActive' }
    );

}

function cargaTipoCuentaSelect(className, tiposelect = 0){

    var html = "";
    
    html += "<option value=\"INCOME\" " + ("INCOME" == tiposelect ? " selected" : "") + ">Ingreso</option>";
    html += "<option value=\"EXPENSES\" " + ("EXPENSES" == tiposelect ? " selected" : "") + ">Egreso</option>";

    const slc = document.querySelector(className);
    slc.innerHTML = html;

}

function ajax(type, url, fn = () => {}, dataJson) {
    
    var xhr = new XMLHttpRequest();

    xhr.open(type, url, true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.onload = () => {
        if (xhr.status >= 200 && xhr.status < 300) { fn(xhr); } 
        else { console.error('Error en la petición:', xhr.statusText); }
    };
    xhr.onerror = () => {  console.error('Error de red'); };
    var data = JSON.stringify(dataJson);
    xhr.send(data);

}

function ajaxReturn(type, url, fn = () => {}, dataJson) {
    
    var xhr = new XMLHttpRequest();
    var returnData = "";

    xhr.open(type, url, false);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.onerror = () => {  console.error('Error de red'); };
    var data = JSON.stringify(dataJson);
    xhr.send(data);

    if (xhr.status >= 200 && xhr.status < 300) { returnData = fn(xhr); } 
    else { console.error('Error en la petición:', xhr.statusText); }

    return returnData;

}

function cargaSelectBanco(className, bancoselect = 0){
    
    bancoselect = bancoselect == 0 ? getBankAcive()[0]['id_bank'] : bancoselect;

    ajax(
        'POST', 
        '../../controller/bank-controller.php', 
        (xhr) => {
            var response = JSON.parse(xhr.responseText);
            var html = "";

            if(Object.entries(response).length == 0){
                html += "";
            }else{
                html += "";
                response.forEach(element => { 
                    html += "<option value=\"" + element["id_bank"] + "\"" + (element["id_bank"] == bancoselect ? " selected" : "") + ">" + element["descripcion"] + " - " + element["tipo_cuenta"] + "</option>";
                });
            }
            
            const sldbank = document.querySelector(className);
            sldbank.innerHTML = "";
            sldbank.innerHTML = html;
        }, 
        { accion: 'getBanks' }
    );

}

function cargaSelectAnios(className, anioselect = 0){
    
    ajax(
        'POST', 
        '../../controller/year-controller.php', 
        (xhr) => {
            var response = JSON.parse(xhr.responseText);
            var html = "";

            if(Object.entries(response).length == 0){
                html += "<option value=\"0\">Año</option>";
            }else{
                html += "<option value=\"0\">Año</option>";
                response.forEach(element => { 
                    html += "<option value=\"" + element["id_year"] + "\"" + (element["id_year"] == anioselect || element["anio"] == anioselect? " selected" : "") + ">" + element["anio"] + "</option>";
                });
            }
            
            const sldyears = document.querySelector(className);
            sldyears.innerHTML = "";
            sldyears.innerHTML = html;
        }, 
        { accion: 'getYears' }
    );

}