<?php
    session_start();
    unset($_SESSION['user_id']);
    unset($_SESSION['name']);
    unset($_SESSION['loggedin']);
    unset($_SESSION['avatar']);

    header('Location: index.php');
?>