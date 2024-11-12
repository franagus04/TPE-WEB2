<?php
    require_once './app/model/home.model.php';
    require_once './app/view/home.view.php';

    class HomeController {
        private $model;
        private $view;

        public function __construct($res){
            $this->model = new HomeModel();
            $this->view = new HomeView($res->user);
        }

        //esta funcion establece los parametros en nulo, lo que hace que la lista se muestre completa
        public function defaultParameters(){ 
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

        //esta funcion muestra el home y le da funcionalidad
        public function showHome(){
            $this->view->showHome();    //llama a las plantillas incluidas en el view del home
            $this->defaultParameters(); //ejecuta la funcion que establece los filtros en nulo en caso de no estar setteados
                                   
            //una vez cargada la pagina lee los parametros actuales de filtracion, asi sean nulos o hayan sido rellenados por el usuario
            $rating = $_POST['vandal_rating'];
            $genre = $_POST['genre'];
            $release = $_POST['release'];
            $class = $_POST['pegi_class'];
            $devs = $_POST['devs'];

            //condicional que muestra la tabla completa cuando todos los filtros estan en nulo
            if ($_POST['vandal_rating']=="NULL" && $_POST['genre']=="NULL" && $_POST['release']=="NULL" && $_POST['pegi_class']=="NULL" && $_POST['devs']=="NULL") {
                $hole_table = $this->model->getHoleTable();
                 $this->view->showTable($hole_table);
            }
            //si se encuentra que un parametro no presenta el valor "NULL" se aplican los filtros propuestos
            else{         
                //redacta una query con los filtros aplicados y devuelve una tabla filtrada
                $filtered_table = $this->model->applyFilter($rating, $genre, $release, $class, $devs);

                //muestra la tabla filtrada 
                $this->view->showTable($filtered_table);                
            }
        }
    }
?>