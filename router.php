<!-- 
           TABLA DE ROUTEO
 __________________________________
|     ACCION     |     DESTINO     |
|________________|_________________|
/home            |showHome();
/game/:id        |showGame(:id);
/admin           |showAdmin();
/admin/login     |showLogIn();
/admin/edit/:id  |showEditor(:id);
/admin/del/:id   |deleteGame(:id);
 __________________________________
-->

<?php
    require_once './app/controller/home.controller.php';
    require_once './app/controller/game.controller.php';
    require_once './app/controller/admin.controller.php';
    require_once './app/controller/auth.controller.php';

    define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');
    
    if(!empty($_GET['action'])){
        $action = $_GET['action'];
    }
    else{
        $action = "home";
    }

    $params = explode("/",$action);

    switch ($params[0]) {
        case 'home':
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
        
        case 'login':
            $auth_controller = new AuthController();
            $auth_controller->showLogIn();
            break;

        case 'logout':
            $auth_controller = new AuthController();
            $auth_controller->logout();
        
        case "admin":
            if (!isset($params[1])) {
                $admin_controller = new AdminController();
                $admin_controller->showAdmin();
            }
            else{
                switch ($params[1]) {
                    case 'edit':
                        $admin_controller = new AdminController();
                        $admin_controller->showEditor($params[2]);
                        break;
                    case 'del':
                        $admin_controller = new AdminController();
                        $admin_controller->deleteGame($params[2]);
                    default:
                        echo "ERROR 404";
                        break;
                }
            }
            
            break;

        default:
            echo "ERROR 404";
            break;
    }