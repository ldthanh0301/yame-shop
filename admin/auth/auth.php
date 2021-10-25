<?php 
    ob_start();
    session_start();

    if (!isset($_SESSION['role']) || $_SESSION['role'] < 1) {
        header("Location: ./404.php");
        die();
    }
?>