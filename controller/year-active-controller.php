<?php 

    require_once("../model/db.php");
    require_once("../model/all-logs.php");
    require_once("../model/year-active.php");

    $year_active = new Year_Active();
    $all_logs = new All_Logs();

    header('Content-Type: application/json');
    $data_input = json_decode(file_get_contents('php://input'), true);

    switch ($data_input['accion']) {

        case "getYearsActive":

            $array_data = $year_active->getYearsActive();
            echo json_encode($array_data);

        break;

        case "getYearActive":

            $array_data = $year_active->getYearActive();
            echo json_encode($array_data);

        break;

        case "updateYearActive":

            $data = [
                'id_year_active' => $data_input['id_year_active']
            ];

            $response = $year_active->updateYearActive($data);

            if($response == 1){

                $data_logs = [
                    'desc' => 'Modificación de datos',
                    'module' => 'Parametros',
                    'sub_module' => 'Mes/Año Activo',
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