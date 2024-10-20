<?php
    require_once './app/view/admin.view.php';
    require_once './app/model/admin.model.php';
    require_once './app/model/pegi.model.php';
    class AdminController{

        private $view;
        private $model;

        public function __construct(){
            $this->view = new AdminView();
            $this->model = new AdminModel();
        }

        public function insertElement(){
            $title_id = $_POST['title_id'];
            $class = $_POST['pegi_class'];
            $title = $_POST['title'];
            $release = $_POST['release'];
            $genre = $_POST['genre'];
            $devs = $_POST['devs'];
            $rating = $_POST['vandal_rating'];
            $thumbnail = $_POST['thumbnail'];
            $this->model->insertGame($title_id, $class, $title, $release, $genre, $devs, $rating, $thumbnail);
        }

        public function editElement($id){
            $title_id = $_POST['title_id'];
            $class = $_POST['pegi_class'];
            $title = $_POST['title'];
            $release = $_POST['release'];
            $genre = $_POST['genre'];
            $devs = $_POST['devs'];
            $rating = $_POST['vandal_rating'];
            $thumbnail = $_POST['thumbnail'];
            $this->model->editGame($id, $title_id, $class, $title, $release, $genre, $devs, $rating, $thumbnail);
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
            if (!isset($_POST['release'])) {
                $_POST['release'] = "NULL";
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
            $_POST['release'] = "NULL";
            $_POST['pegi_class'] = "NULL";
            $_POST['devs'] = "NULL";
        }

        public function showAdmin(){
            $this->defaultParameters();
            $this->view->showAdmin();

            if (!($_POST['vandal_rating']=="NULL" && $_POST['genre']=="NULL" && $_POST['release']=="NULL" && $_POST['pegi_class']=="NULL" && $_POST['devs']=="NULL")) {
                $this->insertElement();
                $this->resetParameters();
            }

            $db = $this->model->getDB();
            $this->view->showDB($db);
        }

        public function showEditor($id){
            $this->defaultParameters();
            $game = $this->model->getGameByid($id);
            $this->view->showEditor($game);
            if (!($_POST['vandal_rating']=="NULL" && $_POST['genre']=="NULL" && $_POST['release']=="NULL" && $_POST['pegi_class']=="NULL" && $_POST['devs']=="NULL")) {
                $this->editElement($id);
            }
        }

        public function deleteGame($id){
            $this->model->deleteGame($id);
            header("Location: ".BASE_URL."admin");
        }
    }
?>