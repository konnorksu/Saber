<?php
  require('_inc/functions.php');
?>
<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/chibi1.png">
    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.js">
    </script>
    <title>Saber</title>
    <?php
      $page_name = basename($_SERVER["SCRIPT_NAME"],'.php');
      $page_object = new Page($page_name);
      $page_object->add_stylesheet();
    ?>
</head>
<body>
    <header>
        <nav>
            <a href="index.php" class="logo"><img src="img/saber-text.png" class="logo"></a>
            <span class="burger">&#8801;</span>
            <div class="menu">
                <ul>
                    <?php
                        $pages = array('Information'=>'page1.php',
                            'Masters'=>'page2.php'
                            //'Alt-version'=>'page4.php'  
                        );
                        $menu_object = new Menu($pages);
                           echo($menu_object->generate_menu());
                           if(isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] == true){
                            echo '<li><a href="logout.php">Logout</a></li>';
                            $menu_object->admin_link();
                           } else echo '<li><a href="page3.php">Login</a></li>';
                    ?>
                </ul>
            </div>
        </nav>
    </header>