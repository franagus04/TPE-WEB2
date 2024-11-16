<?php
    require_once './app/view/user.view.php';
    require_once './app/model/user.model.php';

    class UserController{

        private $view;
        private $model;

        public function __construct($res){
            $this->view = new UserView($res->user);
            $this->model = new UserModel();
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

        public function showAdmin(){
            $this->defaultParameters();
            $this->view->showAdmin();


            $db = $this->model->getDB();
            $this->view->showDB($db);
        }

        public function defaultParameters(){ 
            if (!isset($_POST['title'])) {
                $_POST['title'] = "NULL";
            }
            if (!isset($_POST['title_id'])) {
                $_POST['title_id'] = "NULL";
            }
            if (!isset($_POST['thumbnail'])) {
                $_POST['thumbnail'] = "NULL";
            }
            if (!isset($_POST['vandal_rating'])) {
                $_POST['vandal_rating'] = "NULL";
            }
            if (!isset($_POST['genre'])) {
                $_POST['genre'] = "NULL";
            }
            if (!isset($_POST['year'])) {
                $_POST['year'] = "NULL";
            }
            if (!isset($_POST['pegi_class'])) {
                $_POST['pegi_class'] = "NULL";
            }
            if (!isset($_POST['devs'])) {
                $_POST['devs'] = "NULL";
            }
        }

        public function resetParameters(){ 
            $_POST['vandal_rating'] = "NULL";
            $_POST['genre'] = "NULL";
            $_POST['year'] = "NULL";
            $_POST['pegi_class'] = "NULL";
            $_POST['devs'] = "NULL";
        }
    }
?>