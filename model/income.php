<?php

    setlocale(LC_ALL,"es_ES");
    class Income
    {

        private $income;
        private $db;

        public function __construct(){
            $this->income = array();
            $this->db = new Db();
        }

        public function getIncomes(){

            $sql = "SELECT i.*, b.descripcion AS desc_bank, b.tipo_cuenta AS desc_type FROM income i LEFT JOIN bank b ON i.id_bank = b.id_bank WHERE i.data_active = 1;";
            foreach ($this->db->con($sql) as $res) {
                $this->income[] = [
                    'id_income' => $res['id_income'], 
                    'descripcion' => $res['descripcion'], 
                    'monto' => $res['monto'], 
                    'id_bank' => $res['id_bank'], 
                    'id_month_active' => $res['id_month_active'], 
                    'id_year_active' => $res['id_year_active'], 
                    'fecha_ing' => $res['fecha_ing'], 
                    'type_trans' => $res['type_trans'], 
                    'id_user' => $res['id_user'], 
                    'fecha_set' => $res['fecha_set'], 
                    'fecha_upd' => $res['fecha_upd'], 
                    'fecha_dlt' => $res['fecha_dlt'], 
                    'desc_bank' => $res['desc_bank'], 
                    'desc_type' => $res['desc_type']
                ];
            }
            return $this->income;

        }

        public function getIncomesFilter($data){

            $where = "";

            $desc = $data['desc'];
            $id_bank = $data['id_bank'];
            $mes = $data['mes'];
            $anio = $data['anio'];

            $where .= $desc == "" ? "" : " AND i.descripcion LIKE '%$desc%'";
            $where .= $id_bank == 0 || $id_bank == "" ? "" : " AND i.id_bank = '$id_bank'";
            $where .= $mes == 0 || $mes == "" ? "" : " AND id_month_active = $mes";
            $where .= $anio == 0 || $anio == "" ? "" : " AND id_year_active = $anio";
            // $where .= $mes == 0 || $mes == "" ? "" : " AND MONTH(STR_TO_DATE(i.fecha_ing, '%Y-%m-%d')) = $mes";
            // $where .= $anio == 0 || $anio == "" ? "" : " AND YEAR(STR_TO_DATE(i.fecha_ing, '%Y-%m-%d')) = $anio";

            $sql = "SELECT i.*, b.descripcion AS desc_bank, b.tipo_cuenta AS desc_type FROM income i LEFT JOIN bank b ON i.id_bank = b.id_bank WHERE i.data_active = 1 $where;";
            foreach ($this->db->con($sql) as $res) {
                $this->income[] = [
                    'id_income' => $res['id_income'], 
                    'descripcion' => $res['descripcion'], 
                    'monto' => $res['monto'], 
                    'id_bank' => $res['id_bank'],
                    'id_month_active' => $res['id_month_active'], 
                    'id_year_active' => $res['id_year_active'], 
                    'fecha_ing' => $res['fecha_ing'], 
                    'type_trans' => $res['type_trans'], 
                    'id_user' => $res['id_user'], 
                    'fecha_set' => $res['fecha_set'], 
                    'fecha_upd' => $res['fecha_upd'], 
                    'fecha_dlt' => $res['fecha_dlt'], 
                    'desc_bank' => $res['desc_bank'], 
                    'desc_type' => $res['desc_type']
                ];
            }
            return $this->income;

        }

        public function getIncome($id_income){

            $sql = "SELECT * FROM income WHERE data_active = 1 AND id_income = $id_income;";
            foreach ($this->db->con($sql) as $res) {
                $this->income[] = [
                    'id_income' => $res['id_income'], 
                    'descripcion' => $res['descripcion'], 
                    'monto' => $res['monto'], 
                    'id_bank' => $res['id_bank'], 
                    'id_month_active' => $res['id_month_active'], 
                    'id_year_active' => $res['id_year_active'], 
                    'fecha_ing' => $res['fecha_ing'], 
                    'type_trans' => $res['type_trans'], 
                    'id_user' => $res['id_user'], 
                    'fecha_set' => $res['fecha_set'], 
                    'fecha_upd' => $res['fecha_upd'], 
                    'fecha_dlt' => $res['fecha_dlt']
                ];
            }
            return $this->income;

        }

        public function setIncomes($data){

            $desc = $data['desc'];
            $monto = $data['monto'];
            $fecha_ing = $data['fecha_ing'];
            $tipo = $data['tipo'];
            $id_bank = $data['id_bank'];
            $id_month_active = $data['id_month_active'];
            $id_year_active = $data['id_year_active'];
            $id_user = $data['id_user'];

            date_default_timezone_set('America/Santiago');
            $mes_date = date("n");
            $anio_date = date("Y");
            $dia_date = date("j");
            $mes_date = ($mes_date * 1) < 10 ? '0' . $mes_date : $mes_date;
            $dia_date = ($dia_date * 1) < 10 ? '0' . $dia_date : $dia_date;
            $fecha = $dia_date.'-'.$mes_date.'-'.$anio_date;
            $hora = date("H:i:s");
            $fecha_set = "$fecha $hora";

            $sql = "INSERT INTO income(descripcion, monto, id_bank, id_month_active, id_year_active, fecha_ing, type_trans, id_user, fecha_set, fecha_upd, fecha_dlt)
                    VALUES ('$desc','$monto','$id_bank','$id_month_active','$id_year_active','$fecha_ing','$tipo',$id_user,'$fecha_set','0','0')";

            $result = $this->db->con($sql);
            if ($result) return 1;
            else return 0; 

        }

        public function updateIncomes($data){
            
            $id_income = $data['id_income'];
            $desc = $data['desc'];
            $monto = $data['monto'];
            $fecha_ing = $data['fecha_ing'];
            $tipo = $data['tipo'];
            $id_bank = $data['id_bank'];
            $id_month_active = $data['id_month_active'];
            $id_year_active = $data['id_year_active'];

            date_default_timezone_set('America/Santiago');
            $mes_date = date("n");
            $anio_date = date("Y");
            $dia_date = date("j");
            $mes_date = ($mes_date * 1) < 10 ? '0' . $mes_date : $mes_date;
            $dia_date = ($dia_date * 1) < 10 ? '0' . $dia_date : $dia_date;
            $fecha = $dia_date.'-'.$mes_date.'-'.$anio_date;
            $hora = date("H:i:s");
            $fecha_upd = "$fecha $hora";

            $sql = "UPDATE income SET descripcion = '$desc', monto = '$monto', id_bank = $id_bank, id_month_active = $id_month_active, id_year_active = $id_year_active, fecha_ing = '$fecha_ing', 
                    type_trans = '$tipo', fecha_upd = '$fecha_upd' WHERE id_income = $id_income";

            $result = $this->db->con($sql);
            if ($result) return 1;
            else return 0; 

        }

        public function deleteIncome($id_income){

            date_default_timezone_set('America/Santiago');
            $mes_date = date("n");
            $anio_date = date("Y");
            $dia_date = date("j");
            $mes_date = ($mes_date * 1) < 10 ? '0' . $mes_date : $mes_date;
            $dia_date = ($dia_date * 1) < 10 ? '0' . $dia_date : $dia_date;
            $fecha = $dia_date.'-'.$mes_date.'-'.$anio_date;
            $hora = date("H:i:s");
            $fecha_completa = "$fecha $hora";

            $sql = "UPDATE income SET fecha_dlt = '$fecha_completa', data_active = 0 WHERE id_income = $id_income";

            $result = $this->db->con($sql);
            if ($result) return 1;
            else return 0; 

        }
        
    }
    
?>