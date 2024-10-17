<?php
    require_once './app/controller/game.controller.php';
    class GameView{
        public function showGame($game){
            require_once './templates/layout/header.phtml';
            require_once './templates/game.phtml';
            require_once './templates/layout/footer.phtml';
        }
    }
?>