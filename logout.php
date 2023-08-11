<?php
    session_start();
    if(isset($_SESSION['user']))
    {
        // Destroy the session
        session_destroy();
        // Redirect to another page or perform any other desired action
        header('Location:index.php');
        exit;
    }
    else
    {
        header('Location:index.php');
        exit;
    }
?>