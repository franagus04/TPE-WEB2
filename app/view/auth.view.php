<?php
    class AuthView {
        public function showError($msg){
            echo "<h2>".$msg."</h2>";
        }
        public function showLogIn(){
            require_once './templates/layout/header.phtml';
            require_once './templates/login.phtml';
            require_once './templates/layout/footer.phtml';
        }
    }
?>