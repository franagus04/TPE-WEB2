<?php
    require_once './app/model/home.model.php';
    require_once './app/view/home.view.php';

    class HomeController {
        private $model;
        private $view;

        public function __construct(){
            $this->model = new HomeModel();
            $this->view = new HomeView();
        }
        public function defaultParameters(){
            if (!isset($_POST['vandal_rating'])) {
                $_POST['vandal_rating'] = "null";
            }
            if (!isset($_POST['genre'])) {
                $_POST['genre'] = "null";
            }
            if (!isset($_POST['release'])) {
                $_POST['release'] = "null";
            }
            if (!isset($_POST['pegi_class'])) {
                $_POST['pegi_class'] = "null";
            }
            if (!isset($_POST['devs'])) {
                $_POST['devs'] = "null";
            }
        }
        public function queryRedactor(){
            $query = "SELECT * from listadox360";
    
            if ($_POST['vandal_rating'] != "null") {
                $rating_filter = $_POST['vandal_rating'];
                if ($query == "SELECT * from listadox360") {
                    $query .= " WHERE rating = '".$rating_filter."'";
                }
                $query .= " AND rating = '".$rating_filter."'";
            }
            if ($_POST['genre'] != "null") {
                $genre_filter = $_POST['genre'];
                if ($query == "SELECT * from listadox360") {
                    $query .= " WHERE genre = '".$genre_filter."'";
                }
                $query .= " AND genre = '".$genre_filter."'";
            }
            if ($_POST['release'] != "null") {
                $year_filter = $_POST['release'];
                if ($query == "SELECT * from listadox360") {
                    $query .= " WHERE release = '".$year_filter."'";
                }
                $query .= " AND release = '".$year_filter."'";
            }
            if ($_POST['pegi_class'] != "null") {
                $class_filter = $_POST['pegi_class'];
                if ($query == "SELECT * from listadox360") {
                    $query .= " WHERE pegi_class = '".$class_filter."'";
                }
                $query .= " AND pegi_class = '".$class_filter."'";
            }
            if ($_POST['devs'] != "null") {
                $devs_filter = $_POST['devs'];
                if ($query == "SELECT * from listadox360") {
                    $query .= " WHERE devs = '".$devs_filter."'";
                }
                $query .= " AND devs = '".$devs_filter."'";
            }
            return $query;
        }
        public function showHome(){
            $this->view->showHome();
            $this->defaultParameters();
            if ($_POST['vandal_rating']=="null" && $_POST['genre']=="null" && $_POST['release']=="null" && $_POST['pegi_class']=="null" && $_POST['devs']=="null") {
                $hole_table = $this->model->getHoleTable();
                 $this->view->showTable($hole_table);
            }
            else{
                $query = $this->queryRedactor();
                $filtered_table = $this->model->applyFilter($query);
                $this->view->showTable($filtered_table);
            }
        }
    }
?>