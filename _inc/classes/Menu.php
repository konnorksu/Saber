<?php

    class Menu{
        
        private $pages;

        public function __construct($pages)
        {
            $this->pages = $pages;
        }

        function generate_menu(): string{
            $menuItems = ''; // Inicializácia premennej pre uloženie HTML kódu navigačného menu
            
            // Prechádza všetky položky v zadanom zozname stránok a URL adries
            foreach($this->pages as $page_name => $page_url){
                // Pre každú stránku pridá odkaz do navigačného menu
                $menuItems .= '<li><a href="' . $page_url . '">' . $page_name . '</a></li>';
            }
        
            // Vráti vygenerovaný HTML kód pre navigačné menu
            return $menuItems;
        }

        public function admin_link(){
            if(isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] == true && $_SESSION['is_admin'] == 1){
                echo '<li><a href="admin.php">Admin</a></li>';
                
            }
        }
    }

?>