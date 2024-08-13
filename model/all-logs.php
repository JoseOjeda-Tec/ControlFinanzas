<?php

    setlocale(LC_ALL,"es_ES");
    class All_Logs
    {

        private $all_logs;
        private $db;

        public function __construct(){
            $this->all_logs = array();
            $this->db = new Db();
        }

        public function setLogs($data){

            $desc = $data['desc'];
            $module = $data['module'];
            $sub_module = $data['sub_module'];
            $action = $data['action'];
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

            $sql = "INSERT INTO all_logs(descripcion, modulo, sub_modulo, accion, id_user, fecha_log) 
                    VALUES ('$desc','$module','$sub_module','$action','$id_user','$fecha_completa')";

            $result = $this->db->con($sql);
            if ($result) return 1;
            else return 0; 

        }
        
    }
    
?>