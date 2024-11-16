<?php
    require_once './app/controller/game.controller.php';
    class GameView{
        private $user = null;

        public function __construct($user) {
            $this->user = $user;
        }
        
        public function showGame($game){
            require_once './templates/layout/header.phtml';
            require_once './templates/game.phtml';
            require_once './templates/layout/footer.phtml';
        }

        public function showHome(){
            require_once './templates/layout/header.phtml';
            require_once './templates/filter.form.phtml';
        }
    
        public function showTable($table){
            require_once './templates/table.phtml';
            require_once './templates/layout/footer.phtml';
        }
        
        public function showEditor($game){
            require_once './templates/layout/header.phtml';
            require_once './templates/edit.form.phtml';
            require_once './templates/layout/footer.phtml';
        }
    }
?>