<?php
    class AdminModel{
        private $db;

        public function __construct(){
            $this->db = new PDO('mysql:host=localhost;dbname=g51_x360_db;charset=utf8', 'root', '');
        }

        public function getDB(){
            //consulta por la tabla completa
            $query_db = $this->db->prepare("SELECT * from listadox360");
            //ejecucion de la sentencia
            $query_db->execute();
            //recepcion de datos
            $db = $query_db->fetchAll(PDO::FETCH_OBJ);

            return $db;
        }

        public function insertGame($title_id, $class, $title, $release, $genre, $devs, $rating, $thumbnail){

            //sentencia para insertar un nuevo elemento en la lista
            $query = $this->db->prepare("INSERT INTO `listadox360`(`title_id`, `pegi_class`, `title`, `release`, `genre`, `devs`, `vandal_rating`, `thumbnail`) VALUES (?,?,?,?,?,?,?,?)");
            //ejecucion con declaracion de valores para la sentencia
            $query->execute([$title_id, $class, $title, $release, $genre, $devs, $rating, $thumbnail]);
            return $query;
        }

        public function editGame($id, $title_id, $class, $title, $release, $genre, $devs, $rating, $thumbnail){
            //sentencia para actualizacion del elemento
            $query = $this->db->prepare("UPDATE listadox360 SET `title_id`= ? , `pegi_class`= ? , `title`= ? , `release`= ? , `genre`= ? , `devs`= ? , `vandal_rating`= ? , `thumbnail`= ? WHERE id= ?");
            //ejecucion con declaracion de valores para la sentencia
            $query->execute([$title_id, $class, $title, $release, $genre, $devs, $rating, $thumbnail, $id]);
            return $query;
        }

        public function getGameByid($id){
            //consulta por el juego
            $query_single_game = $this->db->prepare("SELECT * from listadox360 WHERE id = ?");
            //ejecucion de la sentencia
            $query_single_game->execute($id);
            //recepcion de datos almacenado como un objeto singular
            $game = $query_single_game->fetch(PDO::FETCH_OBJ);

            return $game;
        }

        public function deleteGame($id){
            //sentencia para eliminacion del juego
            $query_delete_game = $this->db->prepare("DELETE from listadox360 WHERE id = ?");
            //ejecucion
            $query_delete_game->execute($id);
        }
    }
?>