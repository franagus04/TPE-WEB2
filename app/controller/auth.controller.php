<?php
    require_once './app/view/auth.view.php';
    class AuthController {
        private $view;
        private $model;

        public function __construct(){
            $this->view = new AuthView();
            $this->model = new AdminModel();
        }

        public function showLogin(){
            return $this->view->showLogIn();
        }

        public function logIn(){
            //almacenar las credenciales en variables
            if (isset($_POST['user']) && isset($_POST['pass'])) {
                $user = $_POST['user'];
                $pass = $_POST['pass'];
            }

            if (!isset($_POST['user']) || empty($_POST['user'])) {
                return $this->view->showLogin('Falta ingresar el nombre de usuario');
            }

            if (!isset($_POST['pass']) || empty($_POST['pass'])) {
                return $this->view->showLogin('Falta ingresar la contraseña');
            }

            //buscar coincidencias en la base de datos
            $userFromDB = $this->model->userExists($user);

            if ($userFromDB && password_verify($pass, $userFromDB->pass)) {
                //nueva sesion con cookies que almacenan los datos del usuario
                session_start();
                $_SESSION['ID_USER'] = $userFromDB->id;
                $_SESSION['USERNAME_USER'] = $userFromDB->username;

                //redireccion a la pagina de administracion
                header("Location: " . BASE_URL . "admin");
            }
            else{
                return $this->view->showLogin('Credenciales incorrectas');
            }
        }
        
        public function logOut() {
            session_start(); 
            session_destroy(); 
            header('Location: ' . BASE_URL . 'home');
        }
    
    }
?>