<?php

    setlocale(LC_ALL,"es_ES");
    class Year_Active
    {

        private $year_active;
        private $db;

        public function __construct(){
            $this->year_active = array();
            $this->db = new Db();
        }

        public function getYearsActive(){

            $sql = "SELECT id_year_active, anio, active FROM year_active";
            foreach ($this->db->con($sql) as $res) {
                $this->year_active[] = [
                    'id_year_active' => $res['id_year_active'], 
                    'anio' => $res['anio'], 
                    'active' => $res['active']
                ];
            }
            return $this->year_active;

        }

        public function getYearActive(){

            $sql = "SELECT id_year_active, anio, active FROM year_active WHERE active = 1";
            foreach ($this->db->con($sql) as $res) {
                $this->year_active[] = [
                    'id_year_active' => $res['id_year_active'], 
                    'anio' => $res['anio'], 
                    'active' => $res['active']
                ];
            }
            return $this->year_active;

        }

        public function updateYearActive($data){
            
            $id_year_active = $data['id_year_active'];
    
            $sql = "UPDATE year_active SET active = 0 WHERE id_year_active = (SELECT id_year_active FROM year_active WHERE active = 1);";
            $result = $this->db->con($sql);

            $sql = "UPDATE year_active SET active = 1 WHERE id_year_active = $id_year_active;";
            $result = $this->db->con($sql);
            if ($result) return 1;
            else return 0; 

        }
        
    }
    
?>