<?php
    require_once './app/view/game.view.php';
    require_once './app/model/game.model.php';

    class GameController{
        private $view;
        private $model;
        public function __construct(){
            $this->view = new GameView();
            $this->model = new GameModel();
        }
        public function ShowGameByid($id){
            $game = $this->model->getGameByid($id);
            $this->view->showGame($game);
        }
    }
?>
