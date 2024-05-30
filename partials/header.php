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
      //add_stylesheet();
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
                            'Masters'=>'page2.php',
                            'Sing up'=>'page3.php',
                            //'Alt-version'=>'page4.php'  
                        );
                        //echo(generate_menu($pages));
                        if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true){
                            $pages['odhlasit sa'] = 'logout.php';
                           }
                           $menu_object = new Menu($pages);
                           echo($menu_object->generate_menu());
                    ?>
                </ul>
            </div>
        </nav>
    </header>