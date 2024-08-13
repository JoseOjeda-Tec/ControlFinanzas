<?php

    setlocale(LC_ALL,"es_ES");
    class Bank
    {

        private $bank;
        private $db;

        public function __construct(){
            $this->bank = array();
            $this->db = new Db();
        }

        public function getBanks(){

            $sql = "SELECT id_bank, descripcion, tipo_cuenta, id_user, fecha_set, fecha_upd, fecha_dlt FROM bank WHERE data_active = 1";
            foreach ($this->db->con($sql) as $res) {
                $this->bank[] = [
                    'id_bank' => $res['id_bank'], 
                    'descripcion' => $res['descripcion'], 
                    'tipo_cuenta' => $res['tipo_cuenta'], 
                    'id_user' => $res['id_user'], 
                    'fecha_set' => $res['fecha_set'], 
                    'fecha_upd' => $res['fecha_upd'], 
                    'fecha_dlt' => $res['fecha_dlt']
                ];
            }
            return $this->bank;

        }

        public function getBank($id_bank){

            $sql = "SELECT id_bank, descripcion, tipo_cuenta, id_user, fecha_set, fecha_upd, fecha_dlt FROM bank WHERE data_active = 1 AND id_bank = $id_bank";
            foreach ($this->db->con($sql) as $res) {
                $this->bank[] = [
                    'id_bank' => $res['id_bank'], 
                    'descripcion' => $res['descripcion'], 
                    'tipo_cuenta' => $res['tipo_cuenta'], 
                    'id_user' => $res['id_user'], 
                    'fecha_set' => $res['fecha_set'], 
                    'fecha_upd' => $res['fecha_upd'], 
                    'fecha_dlt' => $res['fecha_dlt']
                ];
            }
            return $this->bank;

        }

        public function setBanks($data){

            $desc = $data['desc'];
            $type_account = $data['type_account'];
            $id_user = $data['id_user'];

            date_default_timezone_set('America/Santiago');
            $mes = date("n");
            $anio = date("Y");
            $dia = date("j");
            $mes = ($mes * 1) < 10 ? '0' . $mes : $mes;
            $dia = ($dia * 1) < 10 ? '0' . $dia : $dia;
            $fecha = $dia.'-'.$mes.'-'.$anio;
            $hora = date("H:i:s");
            $fecha_completa = "$fecha $hora";

            $sql = "INSERT INTO bank(descripcion, tipo_cuenta, id_user, fecha_set, fecha_upd, fecha_dlt) VALUES ('$desc','$type_account','$id_user','$fecha_completa','0','0')";

            $result = $this->db->con($sql);
            if ($result) return 1;
            else return 0; 

        }

        public function updateBank($data){
            
            $id_bank = $data['id_bank'];
            $desc = $data['desc'];
            $type_account = $data['type_account'];

            date_default_timezone_set('America/Santiago');
            $mes = date("n");
            $anio = date("Y");
            $dia = date("j");
            $mes = ($mes * 1) < 10 ? '0' . $mes : $mes;
            $dia = ($dia * 1) < 10 ? '0' . $dia : $dia;
            $fecha = $dia.'-'.$mes.'-'.$anio;
            $hora = date("H:i:s");
            $fecha_completa = "$fecha $hora";

            $sql = "UPDATE bank SET descripcion = '$desc', tipo_cuenta = '$type_account', fecha_upd = '$fecha_completa' WHERE id_bank = $id_bank";

            $result = $this->db->con($sql);
            if ($result) return 1;
            else return 0; 

        }

        public function deleteBank($data){

            $id_bank = $data['id_bank'];

            date_default_timezone_set('America/Santiago');
            $mes = date("n");
            $anio = date("Y");
            $dia = date("j");
            $mes = ($mes * 1) < 10 ? '0' . $mes : $mes;
            $dia = ($dia * 1) < 10 ? '0' . $dia : $dia;
            $fecha = $dia.'-'.$mes.'-'.$anio;
            $hora = date("H:i:s");
            $fecha_completa = "$fecha $hora";

            $sql = "UPDATE bank SET fecha_dlt = '$fecha_completa', data_active = 0 WHERE id_bank = $id_bank";

            $result = $this->db->con($sql);
            if ($result) return 1;
            else return 0; 

        }
        
    }
    
?>