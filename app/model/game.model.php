<?php
    class GameModel{
        private $db;
        
        public function __construct(){
            $this->db = new PDO('mysql:host=localhost;dbname=g51_x360_db;charset=utf8', 'root', '');
        }

        public function getGameByid($id){
            //consulta por el juego
            $query_single_game = $this->db->prepare("SELECT * from game WHERE id_game = ".$id."");
            //ejecucion de la sentencia
            $query_single_game->execute();
            //recepcion de datos almacenado como un objeto singular
            $game = $query_single_game->fetch(PDO::FETCH_OBJ);

            return $game;
        }

        public function insertGame($title_id, $class, $title, $year, $genre, $devs, $rating, $thumbnail){

            //sentencia para insertar un nuevo elemento en la lista
            $query = $this->db->prepare("INSERT INTO `game`(`title_id`, `pegi_class`, `title`, `year`, `genre`, `devs`, `vandal_rating`, `thumbnail`) VALUES (?,?,?,?,?,?,?,?)");
            //ejecucion con declaracion de valores para la sentencia
            $query->execute([$title_id, $class, $title, $year, $genre, $devs, $rating, $thumbnail]);
            return $query;
        }

        public function editGame($id, $title_id, $class, $title, $year, $genre, $devs, $rating, $thumbnail){
            //sentencia para actualizacion del elemento
            $query = $this->db->prepare("UPDATE game SET `title_id`= ? , `pegi_class`= ? , `title`= ? , `year`= ? , `genre`= ? , `devs`= ? , `vandal_rating`= ? , `thumbnail`= ? WHERE id_game = ?");
            //ejecucion con declaracion de valores para la sentencia
            $query->execute([$title_id, $class, $title, $year, $genre, $devs, $rating, $thumbnail, $id]);
            return $query;
        }

        public function deleteGame($id){
            //sentencia para eliminacion del juego
            $query_delete_game = $this->db->prepare("DELETE from game WHERE id_game = ?");
            //ejecucion
            $query_delete_game->execute([$id]);
        }

        public function getHoleTable(){
            //consulta por la tabla completa
            $query_hole_table = $this->db->prepare("SELECT * from game");
            //ejecucion de la sentencia
            $query_hole_table->execute();
            //recepcion de datos
            $hole_table = $query_hole_table->fetchAll(PDO::FETCH_OBJ);

            return $hole_table;
        }

        public function applyFilter($rating, $genre, $year, $class, $devs){ 
            $query = "SELECT * from game";               //comienza la query con la seleccion de la tabla completa
            
            //agrega filtros a la query segun el formulario enviado por el usuario
            if ($_POST['vandal_rating'] != "null") {            //si el parametro no presenta el valor "NULL" añade el filtro a la query
                if ($query == "SELECT * from game") {    //si el query aun no tiene filtros comienza la concatenacion con "WHERE"
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
            if ($_POST['genre'] != "null") {
                if ($query == "SELECT * from game") {
                    $query .= " WHERE genre = '".$genre."'";
                }else{
                    $query .= " AND genre = '".$genre."'";
                }
            }
            if ($_POST['year'] != "null") {
                if ($query == "SELECT * from game") {
                    $query .= " WHERE `year` = '".$year."'";
                }else{
                    $query .= " AND `year` = '".$year."'";
                }
            }
            if ($_POST['pegi_class'] != "null") {
                if ($query == "SELECT * from game") {
                    $query .= " WHERE pegi_class = '".$class."'";
                }else{
                    $query .= " AND pegi_class = '".$class."'";
                }
            }
            if ($_POST['devs'] != "null") {
                if ($query == "SELECT * from game") {
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