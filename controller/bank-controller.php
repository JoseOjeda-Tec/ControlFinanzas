<?php 

    require_once("../model/db.php");
    require_once("../model/all-logs.php");
    require_once("../model/bank.php");

    $banks = new Bank();
    $all_logs = new All_Logs();

    header('Content-Type: application/json');
    $data_input = json_decode(file_get_contents('php://input'), true);

    switch ($data_input['accion']) {
        case "getBanks":

            $array_data = $banks->getBanks();
            echo json_encode($array_data);

        break;

        case "getBank":

            $id_bank = $data_input['id_bank'];
            $array_data = $banks->getBank($id_bank);
            echo json_encode($array_data);

        break;

        case "getBankAcive":

            $array_data = $banks->getBankAcive();
            echo json_encode($array_data);

        break;
        
        case "setBanks":

            $data = [
                'desc' => $data_input['desc'],
                'type_account' => $data_input['type_account'],
                'id_user' => '1'
            ];

            $response = $banks->setBanks($data);

            if($response == 1){

                $data_logs = [
                    'desc' => 'Carga de datos',
                    'module' => 'Parametros',
                    'sub_module' => 'Bancos',
                    'action' => 'set',
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

        case "updateBank":

            $data = [
                'desc' => $data_input['desc'],
                'type_account' => $data_input['type_account'],
                'id_bank' => $data_input['id_bank']
            ];

            $response = $banks->updateBank($data);

            if($response == 1){

                $data_logs = [
                    'desc' => 'Modificación de datos',
                    'module' => 'Parametros',
                    'sub_module' => 'Bancos',
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

        case "updateActiveBank":

            $data = [
                'id_bank' => $data_input['id_bank']
            ];

            $response = $banks->updateActiveBank($data);

            if($response == 1){

                $data_logs = [
                    'desc' => 'Modificación de datos',
                    'module' => 'Parametros',
                    'sub_module' => 'Bancos',
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

        case "deleteBank":

            $data = [
                'id_bank' => $data_input['id_bank']
            ];

            $response = $banks->deleteBank($data);

            if($response == 1){

                $data_logs = [
                    'desc' => 'Eliminación de datos',
                    'module' => 'Parametros',
                    'sub_module' => 'Bancos',
                    'action' => 'Delete',
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