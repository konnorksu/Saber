<?php
    session_start();
    $_SESSION['is_logged_in'] = false;
    $_SESSION['is_admin'] = false;

    header("Location: index.php");
?>