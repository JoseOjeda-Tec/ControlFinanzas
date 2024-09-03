<?php 

    require_once("../model/db.php");
    require_once("../model/all-logs.php");
    require_once("../model/income.php");

    $income = new Income();
    $all_logs = new All_Logs();

    header('Content-Type: application/json');
    $data_input = json_decode(file_get_contents('php://input'), true);

    switch ($data_input['accion']) {
        case "getIncomes":

            $array_data = $income->getIncomes();
            echo json_encode($array_data);

        break;

        case "getIncomesFilter":

            $data = [
                'desc' => $data_input['desc'],
                'id_bank' => $data_input['id_bank'],
                'mes' => $data_input['mes'],
                'anio' => $data_input['anio']
            ];

            $array_data = $income->getIncomesFilter($data);
            echo json_encode($array_data);

        break;

        case "getIncome":

            $id_income = $data_input['id_income'];
            $array_data = $income->getIncome($id_income);
            echo json_encode($array_data);

        break;

        case "setIncomes":

            $data = [
                'desc' => $data_input['desc'],
                'monto' => $data_input['monto'],
                'fecha_ing' => $data_input['fecha_ing'],
                'tipo' => $data_input['tipo'],
                'id_bank' => $data_input['id_bank'],
                'id_month_active' => $data_input['id_month_active'],
                'id_user' => '1'
            ];

            $response = $income->setIncomes($data);

            if($response == 1){

                $data_logs = [
                    'desc' => 'Carga de datos',
                    'module' => 'Ingresos',
                    'sub_module' => '0',
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

        case "updateIncomes":

            $data = [
                'id_income' => $data_input['id_income'],
                'desc' => $data_input['desc'],
                'monto' => $data_input['monto'],
                'fecha_ing' => $data_input['fecha_ing'],
                'tipo' => $data_input['tipo'],
                'id_bank' => $data_input['id_bank'],
                'id_month_active' => $data_input['id_month_active'],
            ];

            $response = $income->updateIncomes($data);

            if($response == 1){

                $data_logs = [
                    'desc' => 'Modificación de datos',
                    'module' => 'Ingresos',
                    'sub_module' => '0',
                    'action' => 'update',
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

        case "deleteIncome":

            $id_income = $data_input['id_income'];
            $response = $income->deleteIncome($id_income);

            if($response == 1){

                $data_logs = [
                    'desc' => 'Eliminación de datos',
                    'module' => 'Ingresos',
                    'sub_module' => '0',
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