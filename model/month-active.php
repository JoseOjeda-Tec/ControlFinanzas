<?php

    setlocale(LC_ALL,"es_ES");
    class Month_Active
    {

        private $month_active;
        private $db;

        public function __construct(){
            $this->month_active = array();
            $this->db = new Db();
        }

        public function getMonthsActive(){

            $sql = "SELECT id_month_active, descripcion, numero, active FROM month_active";
            foreach ($this->db->con($sql) as $res) {
                $this->month_active[] = [
                    'id_month_active' => $res['id_month_active'], 
                    'descripcion' => $res['descripcion'], 
                    'numero' => $res['numero'], 
                    'active' => $res['active']
                ];
            }
            return $this->month_active;

        }

        public function getMonthActive(){

            $sql = "SELECT id_month_active, descripcion, numero, active FROM month_active WHERE active = 1";
            foreach ($this->db->con($sql) as $res) {
                $this->month_active[] = [
                    'id_month_active' => $res['id_month_active'], 
                    'descripcion' => $res['descripcion'], 
                    'numero' => $res['numero'], 
                    'active' => $res['active']
                ];
            }
            return $this->month_active;

        }

        public function updateMonthActive($data){
            
            $id_month_active = $data['id_month_active'];
    
            $sql = "UPDATE month_active SET active = 0 WHERE id_month_active = (SELECT id_month_active FROM month_active WHERE active = 1);";
            $result = $this->db->con($sql);

            $sql = "UPDATE month_active SET active = 1 WHERE id_month_active = $id_month_active;";
            $result = $this->db->con($sql);
            if ($result) return 1;
            else return 0; 

        }
        
    }
    
?>