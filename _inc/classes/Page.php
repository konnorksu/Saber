<?php

    class Page{

        private $page_name;

        public function __construct($page_name)
        {
            $this->page_name = $page_name;
        }

        function add_stylesheet() {
            echo '<link rel="stylesheet" href="../css/style.css">';
            
            switch($this->page_name){
                    case 'index':
                    case 'page1':
                    case 'page2':
                    case 'page3':
                    case 'page4':
                    case 'thank':
                    case 'admin':
                    case 'register':
                    case 'edit':
                        echo '<link rel="stylesheet" href="style/style.css" type="text/css">';
                        break;
                    case 'page21':
                        echo '<link rel="stylesheet" href="style/masters.css" type="text/css">';
                        break;
            }
        }

        function add_scripts(){
            switch($this->page_name){
                case 'index':
                case 'page1':
                case 'page2':
                case 'page4':
                case 'page21':
                case 'thank':
                case 'page3':
                case 'admin':
                case 'register':
                case 'edit':
                    echo('<script src="js/main.js"></script>');
                    break;
            //$page_name = basename($_SERVER["SCRIPT_NAME"],'.php');
            }
            
        }
    }

?>