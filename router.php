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
    require_once 'showBase.php';
    require_once './app/controller/home.controller.php';

    $home_controller = new HomeController;

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
            $home_controller->showHome();
            break;

        // case "game":
        //     showGameByid();
        //     break;
        
        default:
            echo "ERROR 404";
            break;
    }