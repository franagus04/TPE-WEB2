<?php
    require_once './app/controller/home.controller.php';
    class HomeModel{
        private $db;

        public function __construct(){
            //conexion a la base de datos
            $this->db = new PDO('mysql:host=localhost;dbname=g51_x360_db;charset=utf8', 'root', '');
        }
        public function getHoleTable(){
            //consulta por la tabla completa
            $query_hole_table = $this->db->prepare("SELECT * from listadox360");
            //ejecucion de la sentencia
            $query_hole_table->execute();
            //recepcion de datos
            $hole_table = $query_hole_table->fetchAll(PDO::FETCH_OBJ);

            return $hole_table;
        }
        public function applyFilter($query){
            //construccion de la consulta
            $query_filtered_table = $this->db->prepare($query);
    
            //ejecucion de la sentencia
            $query_filtered_table->execute();

            //recepcion de datos
            $filtered_table = $query_filtered_table->fetchAll(PDO::FETCH_OBJ);

            return $filtered_table;
        }
    }
?>
