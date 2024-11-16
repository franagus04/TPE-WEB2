<?php
    class UserModel{
        private $db;

        public function __construct(){
            $this->db = new PDO('mysql:host=localhost;dbname=g51_x360_db;charset=utf8', 'root', '');
        }

        public function getDB(){
            //consulta por la tabla completa
            $query_db = $this->db->prepare("SELECT * from game");
            //ejecucion de la sentencia
            $query_db->execute();
            //recepcion de datos
            $db = $query_db->fetchAll(PDO::FETCH_OBJ);

            return $db;
        }
        
        public function userExists($username){
            $query = $this->db->prepare("SELECT * FROM user WHERE username = ?");
            $query->execute([$username]);

            $user = $query->fetch(PDO::FETCH_OBJ);
            return $user;
        }
    }
?>