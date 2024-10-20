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

        public function applyFilter($rating, $genre, $release, $class, $devs){ 
            $query = "SELECT * from listadox360";               //comienza la query con la seleccion de la tabla completa
            
            //agrega filtros a la query segun el formulario enviado por el usuario
            if ($_POST['vandal_rating'] != "NULL") {            //si el parametro no presenta el valor "NULL" añade el filtro a la query
                if ($query == "SELECT * from listadox360") {    //si el query aun no tiene filtros comienza la concatenacion con "WHERE"
                    if ($rating == "positive") {
                        $query .= " WHERE vandal_rating >= 8";
                    }else if ($rating == "negative"){    
                        $query .= " WHERE vandal_rating <= 7";
                    }
                }else{                                          //si el query ya tiene algun filtro comienza la concatenacion con "AND"
                    if ($rating == "positive") {
                        $query .= " AND vandal_rating >= 8";
                    }else if ($rating == "negative"){
                        $query .= " AND vandal_rating <= 7";
                    }
                }                                               
            }                                                   //el codigo repite el patron con todos los filtros aplicables
            if ($_POST['genre'] != "NULL") {
                if ($query == "SELECT * from listadox360") {
                    $query .= " WHERE genre = '".$genre."'";
                }else{
                    $query .= " AND genre = '".$genre."'";
                }
            }
            if ($_POST['release'] != "NULL") {
                if ($query == "SELECT * from listadox360") {
                    $query .= " WHERE `release` = '".$release."'";
                }else{
                    $query .= " AND `release` = '".$release."'";
                }
            }
            if ($_POST['pegi_class'] != "NULL") {
                if ($query == "SELECT * from listadox360") {
                    $query .= " WHERE pegi_class = '".$class."'";
                }else{
                    $query .= " AND pegi_class = '".$class."'";
                }
            }
            if ($_POST['devs'] != "NULL") {
                if ($query == "SELECT * from listadox360") {
                    $query .= " WHERE devs = '".$devs."'";
                }else{
                    $query .= " AND devs = '".$devs."'";
                }
            }

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
