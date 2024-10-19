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
        public function ShowGameByid($id){          //muestra la pagina singular de cada juego
            $game = $this->model->getGameByid($id); //toma el juego segun el id otorgado por el action y lo guarda como objeto en una variable
            $this->view->showGame($game);           //ejecuta una funcion que muestra el juego almacenado como objeto
        }
    }
?>
