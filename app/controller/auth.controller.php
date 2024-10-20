<?php
    require_once './app/view/auth.view.php';
    require_once './app/model/user.model.php';
    class AuthController {
        private $view;
        private $model;

        public function __construct(){
            $this->view = new AuthView();
            $this->model = new UserModel();
        }

        public function showLogIn(){
            $this->view->showLogIn();
            if (!empty($_POST["user"]) && !empty($_POST["pass"])) {
                $this->logIn();
            }
        }

        public function logIn(){
            //almacenar las credenciales en variables
            $user = $_POST['user'];
            $pass = $_POST['pass'];

            //buscar coincidencias en la base de datos
            $userFromDB = $this->model->userExists($user);

            if (password_verify($pass, $userFromDB->pass)) {
                //nueva sesion con cookies que almacenan los datos del usuario
                session_start();
                $_SESSION['ID_USER'] = $userFromDB->id;
                $_SESSION['USERNAME_USER'] = $userFromDB->username;

                //redireccion a la pagina de administracion
                header("Location: ".BASE_URL."admin");
            }
            else{
                return $this->view->showError('Credenciales incorrectas');
            }
        }
    }
?>