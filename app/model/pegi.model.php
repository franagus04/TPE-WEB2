<?php
class pegiModel{

    private $db;

    public function __construct(){
        $this->db = new PDO('mysql:host=localhost;dbname=g51_x360_db;charset=utf8', 'root', '');
    }

    public function getAllPegis(){
        //consulta por la tabla completa
        $query_db = $this->db->prepare("SELECT * from pegi");
        //ejecucion de la sentencia
        $query_db->execute();
        //recepcion de datos
        $db = $query_db->fetchAll(PDO::FETCH_OBJ);

        return $db;
    }

    function getPegi($id){
        $query = $this->db->prepare("SELECT * FROM pegi WHERE id_pegi = ?");
        $query->execute( $id);
        $pegi = $query->fetch(PDO::FETCH_OBJ);
        return $pegi;
    }
    
    function insertPegi($age_range, $esrb_class){
        $query = $this->db->prepare("INSERT INTO pegi(age_range, esrb_class) VALUES(?,?)");
        $query->execute([$age_range, $esrb_class]);
    }

    function deletePegi($id){
        $query = $this->db->prepare("DELETE FROM pegi WHERE id_pegi = ?");
        $query->execute($id);
    }

}