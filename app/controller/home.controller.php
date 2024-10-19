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

        //esta funcion establece los parametros en nulo, lo que hace que la lista se muestre completa
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

        //esta funcion redacta un query basado en los filtros propuestos por el usuario
        public function queryRedactor(){ 
            $query = "SELECT * from listadox360";               //comienza la query con la seleccion de la tabla completa
            
            //agrega filtros al query segun el formulario enviado por el usuario
            if ($_POST['vandal_rating'] != "null") {            //si el parametro no presenta el valor "null" comienza a añadir filtros al query
                $rating_filter = $_POST['vandal_rating'];
                if ($query == "SELECT * from listadox360") {    //si el query aun no tiene filtros comienza la concatenacion con "WHERE"
                    if ($rating_filter == "positive") {
                        $query .= " WHERE vandal_rating >= 8";
                    }else if ($rating_filter == "negative"){    
                        $query .= " WHERE vandal_rating <= 7";
                    }
                }else{                                          //si el query ya tiene algun filtro comienza la concatenacion con "AND"
                    if ($rating_filter == "positive") {
                        $query .= " AND vandal_rating >= 8";
                    }else if ($rating_filter == "negative"){
                        $query .= " AND vandal_rating <= 7";
                    }
                }                                               
            }                                                   //el codigo repite el patron con todos los filtros aplicables
            if ($_POST['genre'] != "null") {
                $genre_filter = $_POST['genre'];
                if ($query == "SELECT * from listadox360") {
                    $query .= " WHERE genre = '".$genre_filter."'";
                }else{
                    $query .= " AND genre = '".$genre_filter."'";
                }
            }
            if ($_POST['release'] != "null") {
                $release_filter = $_POST['release'];
                if ($query == "SELECT * from listadox360") {
                    $query .= " WHERE `release` = '".$release_filter."'";
                }else{
                    $query .= " AND `release` = '".$release_filter."'";
                }
            }
            if ($_POST['pegi_class'] != "null") {
                $class_filter = $_POST['pegi_class'];
                if ($query == "SELECT * from listadox360") {
                    $query .= " WHERE pegi_class = '".$class_filter."'";
                }else{
                    $query .= " AND pegi_class = '".$class_filter."'";
                }
            }
            if ($_POST['devs'] != "null") {
                $devs_filter = $_POST['devs'];
                if ($query == "SELECT * from listadox360") {
                    $query .= " WHERE devs = '".$devs_filter."'";
                }else{
                    $query .= " AND devs = '".$devs_filter."'";
                }
            }
            return $query;
        }
        public function showHome(){     //esta funcion muestra el home y le da funcionalidad
            $this->view->showHome();    //llama a las plantillas incluidas en el view del home
            $this->defaultParameters(); //ejecuta la funcionque establece los paramentros en nulo

            //condicional que muestra la tabla completa cuando todos los filtros estan en "null"
            if ($_POST['vandal_rating']=="null" && $_POST['genre']=="null" && $_POST['release']=="null" && $_POST['pegi_class']=="null" && $_POST['devs']=="null") {
                $hole_table = $this->model->getHoleTable();
                 $this->view->showTable($hole_table);
            }
            //si se encuentra que un parametro no presenta el valor "null" se aplican los filtros propuestos
            else{                           
                $query = $this->queryRedactor();                        //redacta una query
                $filtered_table = $this->model->applyFilter($query);    //lleva la query a una consulta
                $this->view->showTable($filtered_table);                //muestra la tabla filtrada
            }
        }
    }
?>