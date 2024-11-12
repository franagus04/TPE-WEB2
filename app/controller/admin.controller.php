<?php
    require_once './app/view/admin.view.php';
    require_once './app/model/admin.model.php';
    require_once './app/model/game.model.php';

    class AdminController{

        private $adminView;
        private $adminModel;
        private $gameModel;

        public function __construct($res){
            $this->adminView = new AdminView($res->user);
            $this->adminModel = new AdminModel();
            $this->gameModel = new GameModel();
        }

        public function showAdmin(){
            $this->defaultParameters();
            $this->adminView->showAdmin();


            $db = $this->adminModel->getDB();
            $this->adminView->showDB($db);
        }

        public function showEditor($id){
            $this->defaultParameters();
            $game = $this->gameModel->getGameByid($id);
            $this->adminView->showEditor($game);
            if (!($_POST['vandal_rating']=="NULL" && $_POST['genre']=="NULL" && $_POST['release']=="NULL" && $_POST['pegi_class']=="NULL" && $_POST['devs']=="NULL")) {
                $this->editElement($id);
            }
        }

        public function addElement(){
            $title_id = $_POST['title_id'];
            $class = $_POST['pegi_class'];
            $title = $_POST['title'];
            $release = $_POST['release'];
            $genre = $_POST['genre'];
            $devs = $_POST['devs'];
            $rating = $_POST['vandal_rating'];
            $thumbnail = $_POST['thumbnail'];
            $this->gameModel->insertGame($title_id, $class, $title, $release, $genre, $devs, $rating, $thumbnail);
            header("Location: ".BASE_URL."admin");
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
            $this->gameModel->editGame($id, $title_id, $class, $title, $release, $genre, $devs, $rating, $thumbnail);
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

        public function deleteGame($id){
            $this->gameModel->deleteGame($id);
            header("Location: ".BASE_URL."admin");
        }
    }
?>