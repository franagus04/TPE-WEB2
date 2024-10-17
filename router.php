<!-- 
           TABLA DE ROUTEO
 __________________________________
|     ACCION     |     DESTINO     |
|________________|_________________|
/home            |showHome();
/game/:id        |showGame(:id);
 __________________________________
-->

<?php
    require_once './app/controller/home.controller.php';
    require_once './app/controller/game.controller.php';

    define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');
    
    if(!empty($_GET['action'])){
        $action = $_GET['action'];
    }
    else{
        $action = "home";
    }

    $params = explode("/",$action);

    switch ($params[0]) {
        case "home":
            $home_controller = new HomeController();
            $home_controller->showHome();
            break;

        case "game":
            if (!isset($params[1])) {
                $home_controller = new HomeController();
                $home_controller->showHome();
            }
            else{
                $game_controller = new GameController();
                $game_controller->ShowGameByid($params[1]);
            }
            break;
        
        default:
            echo "ERROR 404";
            break;
    }