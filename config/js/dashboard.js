window.onload = function() {
    asignaFuncionBotonesPrincipales();
    asignaDatos();
}

function formatMoney(nunero){
    let money = new Intl.NumberFormat('de-DE').format(nunero);
    return money;
}

function asignaDatos(){

    var datecomplete = new  Date();
    var fullyear = datecomplete.getFullYear();
    var mesActual = getMonthAcive()[0]['id_month_active'];

    var parametros = {
        accion: 'getIncomesFilter',
        'desc' : '',
        'id_bank' : getBankAcive()[0]['id_bank'],
        'mes' : mesActual,
        'anio' : fullyear
    };

    ajax(
        'POST', 
        '../../controller/income-controller.php', 
        (xhr) => {
            var response = JSON.parse(xhr.responseText);
            var total_ing_input = 0;
            var total_egr_input = 0;
            var total_rest_input = 0;

            if(Object.entries(response).length == 0){
                total_ing_input = 0;
                total_egr_input = 0;
                total_rest_input = 0;
            }else{
                response.forEach(element => {
                    if(element['type_trans'] == 'INCOME'){ total_ing_input = total_ing_input + (element["monto"] * 1); }
                    if(element['type_trans'] == 'EXPENSES'){ total_egr_input = total_egr_input + (element["monto"] * 1); }
                    total_rest_input = total_ing_input - total_egr_input;
                    total_rest_input = total_rest_input < 1 ? 0 : total_rest_input;
                    
                });
            }
            
            const ttling = document.querySelector("#id-income");
            const ttlegr = document.querySelector("#id-expenses");
            const ttlrest = document.querySelector("#id-rest");
            
            ttling.text = "$" + formatMoney(total_ing_input);
            ttlegr.text = "$" + formatMoney(total_egr_input);
            ttlrest.text = "$" + formatMoney(total_rest_input);
        }, 
        parametros
    );

}