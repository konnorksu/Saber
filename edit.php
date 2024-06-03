<?php
    include_once('partials/header.php');
    if(!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] == 0){
        header("Location: 404.php");
    }
    $user_object = new User();
    $master_object = new Masters();
    $navigation_object = new Table();
?>   
    <main>
    <div class="parallax bg01">
        <div class="content-in-parallax w80">
            <?php
                $navigation_object->edit_interface($_POST['edit']);
            ?>
        </div>
    </div>
    </main>
<?php
    include_once('partials/footer.php');
?>