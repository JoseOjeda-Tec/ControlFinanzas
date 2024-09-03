window.onload = function() {
    asignaFuncionBotonesPrincipales();
    asignaFuncionBotonesParametros();
    desactivaBotonEdicion();
    asignaFuncionBotones();
    getBanks();
}

function desactivaBotonEdicion(charge = 0){

    const btnedit = document.querySelector(".edit-parameters-btn");
    const btnsave = document.querySelector("#btn-save");

    if (charge == 0) {
        btnedit.style = "display: none;";
        btnsave.style = "display: block;";
    } else {
        btnedit.style = "display: block;";
        btnsave.style = "display: none;";
    }

}

function asignaFuncionBotones(){

    const btnsave = document.querySelector("#btn-save");
    const btnclean = document.querySelector("#btn-clean");
    const btnedit = document.querySelector(".edit-parameters-btn");

    btnsave.addEventListener("click", ()=>{ setBanks(); });
    btnedit.addEventListener("click", ()=>{ updateBank(); });
    btnclean.addEventListener("click", ()=>{ limpiarCampos(); });

}

function limpiarCampos(){

    const desc = document.querySelector("#descripcion");
    const type_account = document.querySelector("#tipo-cuenta");
    const btnedit = document.querySelector(".edit-parameters-btn");
    const btnsave = document.querySelector("#btn-save");

    desc.value = "";
    type_account.value = "";
    btnsave.style = "display: block;";
    btnedit.style = "display: none;";

}

function getBanks(){

    ajax(
        'POST', 
        '../../controller/bank-controller.php', 
        (xhr) => {
            var response = JSON.parse(xhr.responseText);
            var html = "";
            var btnactive = "";

            if(Object.entries(response).length == 0){
                html += "<div class=\"data-info\">";
                    html += "<div class=\"info-item\"><h5>No hay Bancos registrados</h5></div>";
                html += "</div>";
            }else{
                response.forEach(element => { 

                    btnactive = element["active"] == 0 ? "<button type=\"button\" class=\"chk-btn btn-opc-item\" onclick=\"updateActiveBank(" + element["id_bank"] + ")\"><i class=\"fa-solid fa-circle-check\"></i></button>" : "";

                    html += "<div class=\"data-info\">";
                        html += "<div class=\"id-bank\"><p id=\"data-id\">" + element["id_bank"] + "</p></div>";
                        html += "<div class=\"desc-bank\"><p id=\"data-desc\">" + element["descripcion"] + "</p></div>";
                        html += "<div class=\"tipo-bank\"><p id=\"data-tipo\">" + element["tipo_cuenta"] + "</p></div>";
                        html += "<div class=\"opc-bank\">";
                            html += btnactive;
                            html += "<button type=\"button\" class=\"edit-btn btn-opc-item\" onclick=\"getBank(" + element["id_bank"] + ")\"><i class=\"fa-solid fa-pen\"></i></button>";
                            html += "<button type=\"button\" class=\"delete-btn btn-opc-item\" onclick=\"deleteBank(" + element["id_bank"] + ")\"><i class=\"fa-solid fa-xmark\"></i></button>";
                        html += "</div>";
                    html += "</div>";
                });
            }
            
            const cntlistparam = document.querySelector(".listado-registro-parameters");
            cntlistparam.innerHTML = "";
            cntlistparam.innerHTML = html;
        }, 
        { accion: 'getBanks' }
    );

}

function getBank(id_bank){

    ajax(
        'POST', 
        '../../controller/bank-controller.php', 
        (xhr) => {
            var response = JSON.parse(xhr.responseText);
            const desc = document.querySelector("#descripcion");
            const type_account = document.querySelector("#tipo-cuenta");
            const id_bank_hidd = document.querySelector("#id-edit-bank");

            response.forEach(element => { 
                id_bank_hidd.value = element["id_bank"];
                desc.value = element["descripcion"];
                type_account.value = element["tipo_cuenta"];
            });

            desactivaBotonEdicion(1);

        }, 
        { accion: 'getBank', 'id_bank' : id_bank }
    );

}

function setBanks(){

    let boolData = true;
    const desc = document.querySelector("#descripcion");
    const type_account = document.querySelector("#tipo-cuenta");

    boolData = desc.value == "" ? false : true;
    if(boolData == false){ alert('Debe ingresar el banco'); return;}

    boolData = type_account.value == "" ? false : true;
    if(boolData == false){ alert('Debe ingresar el tipo de cuenta'); return;}

    if(boolData){
        var parametros = {
            'accion' : 'setBanks',
            'desc' : desc.value,
            'type_account' : type_account.value
        };
    
        ajax(
            'POST', 
            '../../controller/bank-controller.php', 
            (xhr) => {
                var response = JSON.parse(xhr.responseText);
                if(response["respuesta"] == 1){
                    console.log(response["mensaje"]);
                    limpiarCampos();
                    getBanks();
                }
            }, 
            parametros 
        );
    }

}

function updateBank(){

    let boolData = true;
    const id_bank_hidd = document.querySelector("#id-edit-bank");
    const desc = document.querySelector("#descripcion");
    const type_account = document.querySelector("#tipo-cuenta");

    boolData = desc.value == "" ? false : true;
    if(boolData == false){ alert('Debe ingresar el banco'); return;}

    boolData = type_account.value == "" ? false : true;
    if(boolData == false){ alert('Debe ingresar el tipo de cuenta'); return;}

    if(boolData){
        var parametros = {
            'accion' : 'updateBank',
            'id_bank' : id_bank_hidd.value,
            'desc' : desc.value,
            'type_account' : type_account.value
        };
    
        ajax(
            'POST', 
            '../../controller/bank-controller.php', 
            (xhr) => {
                var response = JSON.parse(xhr.responseText);
                if(response["respuesta"] == 1){
                    console.log(response["mensaje"]);
                    limpiarCampos();
                    getBanks();
                }
            }, 
            parametros 
        );
    }

}

function updateActiveBank(id_bank){

    var parametros = {
        'accion' : 'updateActiveBank',
        'id_bank' : id_bank
    };

    ajax(
        'POST', 
        '../../controller/bank-controller.php', 
        (xhr) => {
            var response = JSON.parse(xhr.responseText);
            if(response["respuesta"] == 1){
                console.log(response["mensaje"]);
                getBanks();
            }
        }, 
        parametros 
    );

}

function deleteBank(id_bank){

    var parametros = {
        'accion' : 'deleteBank',
        'id_bank' : id_bank
    };

    ajax(
        'POST', 
        '../../controller/bank-controller.php', 
        (xhr) => {
            var response = JSON.parse(xhr.responseText);
            if(response["respuesta"] == 1){
                console.log(response["mensaje"]);
                limpiarCampos();
                getBanks();
            }
        }, 
        parametros 
    );

}