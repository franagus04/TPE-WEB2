<?php
    require_once './app/view/game.view.php';
    require_once './app/model/game.model.php';

    class GameController{
        private $view;
        private $model;
        
        public function __construct($res){
            $this->view = new GameView($res->user);
            $this->model = new GameModel();
        }
        public function ShowGameByid($id){          //muestra la pagina singular de cada juego
            $game = $this->model->getGameByid($id); //toma el juego segun el id otorgado por el action y lo guarda como objeto en una variable
            $this->view->showGame($game);           //ejecuta una funcion que muestra el juego almacenado como objeto
        }

        //esta funcion establece los parametros en nulo, lo que hace que la lista se muestre completa
        public function defaultParameters(){ 
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

        //esta funcion muestra el home y le da funcionalidad
        public function showHome(){
            $this->view->showHome();    //llama a las plantillas incluidas en el view del home
            $this->defaultParameters(); //ejecuta la funcion que establece los filtros en nulo en caso de no estar setteados
                                   
            //una vez cargada la pagina lee los parametros actuales de filtracion, asi sean nulos o hayan sido rellenados por el usuario
            $rating = $_POST['vandal_rating'];
            $genre = $_POST['genre'];
            $year = $_POST['year'];
            $class = $_POST['pegi_class'];
            $devs = $_POST['devs'];

            //condicional que muestra la tabla completa cuando todos los filtros estan en nulo
            if ($_POST['vandal_rating']=="NULL" && $_POST['genre']=="NULL" && $_POST['year']=="NULL" && $_POST['pegi_class']=="NULL" && $_POST['devs']=="NULL") {
                $hole_table = $this->model->getHoleTable();
                 $this->view->showTable($hole_table);
            }
            //si se encuentra que un parametro no presenta el valor "NULL" se aplican los filtros propuestos
            else{         
                //redacta una query con los filtros aplicados y devuelve una tabla filtrada
                $filtered_table = $this->model->applyFilter($rating, $genre, $year, $class, $devs);

                //muestra la tabla filtrada 
                $this->view->showTable($filtered_table);                
            }
        }

        public function addElement(){
            $title_id = $_POST['title_id'];
            $class = $_POST['pegi_class'];
            $title = $_POST['title'];
            $year = $_POST['year'];
            $genre = $_POST['genre'];
            $devs = $_POST['devs'];
            $rating = $_POST['vandal_rating'];
            $thumbnail = $_POST['thumbnail'];
            $this->model->insertGame($title_id, $class, $title, $year, $genre, $devs, $rating, $thumbnail);
            header("Location: ".BASE_URL."admin");
        }

        public function deleteGame($id){
            $this->model->deleteGame($id);
            header("Location: ".BASE_URL."admin");
        }

        public function showEditor($id){
            $this->defaultParameters();
            $game = $this->model->getGameByid($id);
            $this->view->showEditor($game);
            if (!($_POST['vandal_rating']=="NULL" && $_POST['genre']=="NULL" && $_POST['year']=="NULL" && $_POST['pegi_class']=="NULL" && $_POST['devs']=="NULL")) {
                $this->editElement($id);
            }
        }

        public function editElement($id){
            $title_id = $_POST['title_id'];
            $class = $_POST['pegi_class'];
            $title = $_POST['title'];
            $year = $_POST['year'];
            $genre = $_POST['genre'];
            $devs = $_POST['devs'];
            $rating = $_POST['vandal_rating'];
            $thumbnail = $_POST['thumbnail'];
            $this->model->editGame($id, $title_id, $class, $title, $year, $genre, $devs, $rating, $thumbnail);
        }
    }
?>
