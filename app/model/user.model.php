<?php
    class UserModel {
        private $db;

        public function __construct (){
            $this->db = new PDO('mysql:host=localhost;dbname=g51_x360_db;charset=utf8', 'root', '');
        }

        public function userExists($username){
            $query = $this->db->prepare("SELECT * FROM usuarios WHERE username = ?");
            $query->execute([$username]);

            $user = $query->fetch(PDO::FETCH_OBJ);
            return $user;
        }
    }
?>