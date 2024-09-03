<?php 

    require_once("../model/db.php");
    require_once("../model/all-logs.php");
    require_once("../model/month-active.php");

    $month_active = new Month_Active();
    $all_logs = new All_Logs();

    header('Content-Type: application/json');
    $data_input = json_decode(file_get_contents('php://input'), true);

    switch ($data_input['accion']) {

        case "getMonthsAcive":

            $array_data = $month_active->getMonthsAcive();
            echo json_encode($array_data);

        break;

        case "getMonthAcive":

            $array_data = $month_active->getMonthAcive();
            echo json_encode($array_data);

        break;

        case "updateMonthActive":

            $data = [
                'id_month_active' => $data_input['id_month_active']
            ];

            $response = $month_active->updateMonthActive($data);

            if($response == 1){

                $data_logs = [
                    'desc' => 'Modificación de datos',
                    'module' => 'Parametros',
                    'sub_module' => 'Mes Activo',
                    'action' => 'Update',
                    'id_user' => '1'
                ];

                $response_log = $all_logs->setLogs($data_logs);
            }

            $resp_json = [
                "respuesta" => $response == 1 ? 1 : 0,
                "mensaje" => $response == 1 ? "Consulta exitosa" : "Error en la consulta"
            ];

            echo json_encode($resp_json);

        break;
    }

?>