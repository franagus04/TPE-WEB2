<?php
    class AuthView {
        private $user = null;


        public function showLogIn($error = ''){
            require_once './templates/layout/header.phtml';
            require_once './templates/login.phtml';
            require_once './templates/layout/footer.phtml';
        }
    }
?>