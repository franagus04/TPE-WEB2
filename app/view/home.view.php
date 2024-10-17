<?php
    class HomeView {

        function showHome(){
            require_once './templates/layout/header.phtml';
            require_once './templates/form.phtml';
        }
    
        function showTable($table){
            require_once './templates/table.phtml';
            require_once './templates/layout/footer.phtml';
        }
    }
?>
