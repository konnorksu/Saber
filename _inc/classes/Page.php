<?php

    class Page{

        private $page_name;

        public function __construct($page_name)
        {
            $this->page_name = $page_name;
        }

        function add_stylesheet() {
            echo '<link rel="stylesheet" href="../css/style.css">';
        
            //$page_name = basename($_SERVER["SCRIPT_NAME"], '.php');
            
            switch($this->page_name){
                    case 'index':
                    case 'page1':
                    case 'page2':
                    case 'page3':
                    case 'page4':
                    case 'thank':
                        echo '<link rel="stylesheet" href="style/style.css" type="text/css">';
                        break;
                    case 'page21':
                        echo '<link rel="stylesheet" href="style/masters.css" type="text/css">';
                        break;
            }
        }
            /**
         * Generuje odkazy na JS súbory pre pätu stránky
         *
         * Táto funkcia generuje odkazy na základné JS súbory a pridáva odkazy na špecifické
         * JS súbory podľa názvu aktuálnej stránky. Odkazy sú vložené na koniec body tagu.
         *
         * @return void
         */
        function add_scripts(){
            echo('<script src="../js/main.js"></script>');
            //$page_name = basename($_SERVER["SCRIPT_NAME"],'.php');
            
        }
    }

?>