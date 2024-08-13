<?php 
    class Db{

        private $db; 

        public function __construct(){
            $this->db = new PDO('mysql:host=db;dbname=controlfinanzas', "myuser", "mypassword");//local
        }
    
        private function setNames() {
            return $this->db->query("SET NAMES 'utf8'");
        }

        //Funcion generica que ejecuta cualquier consulta a la base de datos
        function con($sql){
            self::setNames();
            $res = $this->db->query($sql);
            return $res;
            $this->db = null;
        }
    
    }
?>