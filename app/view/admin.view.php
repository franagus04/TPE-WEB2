<?php
    class AdminView{

        private $user = null;

        public function __construct($user) {
            $this->user = $user;
        }

        public function showAdmin(){
            require_once './templates/layout/header.phtml';
            require_once './templates/add.form.phtml';
        }

        public function showDB($db){
            require_once './templates/admin.table.phtml';
            require_once './templates/layout/footer.phtml';
        }
        
        public function showEditor($game){
            require_once './templates/layout/header.phtml';
            require_once './templates/edit.form.phtml';
            require_once './templates/layout/footer.phtml';
        }
    }
?>