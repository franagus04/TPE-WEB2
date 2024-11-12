<!-- 
           TABLA DE ROUTEO
 __________________________________
|     ACCION     |     DESTINO     |
|________________|_________________|
/home            |showHome();
/game/:id        |showGame(:id);
/showLogin       |showLogIn();
/logIn           |logIn();
/admin           |showAdmin();
/edit/:id        |showEditor(:id);
/del/:id         |deleteGame(:id);
 __________________________________
-->

<?php
    require_once './libs/response.php';
    require_once './app/middlewares/session.auth.middleware.php';
    require_once './app/middlewares/verify.auth.middleware.php';    
    require_once './app/controller/listadox360.controller.php';
    require_once './app/controller/game.controller.php';
    require_once './app/controller/admin.controller.php';
    require_once './app/controller/auth.controller.php';

    define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');
    
    //declaracion de respuesta de usuario
    $res = new Response();

    //manipulacion incial del action
    if(!empty($_GET['action'])){
        $action = $_GET['action'];
    }
    else{
        $action = "home";
    }
    $params = explode("/",$action);

    switch ($params[0]) {
        case 'home':
            sessionAuthMiddleware($res);
            $home_controller = new listadox360Controller($res);
            $home_controller->showHome();
            break;

        case "game":
            sessionAuthMiddleware($res);
            if (!isset($params[1])) {
                $home_controller = new listadox360Controller($res);
                $home_controller->showHome();
            }
            else{
                $game_controller = new GameController($res);
                $game_controller->ShowGameByid($params[1]);
            }
            break;

        case 'showLogIn':
            $auth_controller = new AuthController();
            $auth_controller->showLogin();
            break;

        case 'login':
            $auth_controller = new AuthController();
            $auth_controller->logIn();
            break;

        case 'logout':
            $auth_controller = new AuthController();
            $auth_controller->logOut();
            break;
        
        case "admin":
            sessionAuthMiddleware($res);
            verifyAuthMiddleware($res);
            $admin_controller = new AdminController($res);
            $admin_controller->showAdmin();
            break;

        case 'add':
            sessionAuthMiddleware($res);
            verifyAuthMiddleware($res);
            $admin_controller = new AdminController($res);
            $admin_controller->addElement($params[1]);
            break;

        case 'edit':
            sessionAuthMiddleware($res);
            verifyAuthMiddleware($res);
            $admin_controller = new AdminController($res);
            $admin_controller->showEditor($params[1]);
            break;

        case 'del':
            sessionAuthMiddleware($res);
            verifyAuthMiddleware($res);
            $admin_controller = new AdminController($res);
            $admin_controller->deleteGame($params[1]);
            break;

        default:
            echo "ERROR 404";
            break;
    }