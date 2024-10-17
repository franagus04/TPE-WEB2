<?php
    class GameModel{
        private $db;
        public function __construct(){
            $this->db = new PDO('mysql:host=localhost;dbname=g51_x360_db;charset=utf8', 'root', '');
        }
        public function getGameByid($id){
            //consulta por el juego
            $query_single_game = $this->db->prepare("SELECT * from listadox360 WHERE id = ".$id."");
            //ejecucion de la sentencia
            $query_single_game->execute();
            //recepcion de datos
            $game = $query_single_game->fetch(PDO::FETCH_OBJ);

            return $game;
        }
    }
?>