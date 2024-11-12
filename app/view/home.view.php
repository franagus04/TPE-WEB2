<?php
    class HomeView {
        private $user = null;

        public function __construct($user) {
            $this->user = $user;
        }

        function showHome(){
            require_once './templates/layout/header.phtml';
            require_once './templates/filter.form.phtml';
        }
    
        function showTable($table){
            require_once './templates/table.phtml';
            require_once './templates/layout/footer.phtml';
        }
    }
?>
