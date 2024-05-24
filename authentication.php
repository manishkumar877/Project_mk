<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


if (!isset($_SESSION['loggedInStatus'])) {
    $_SESSION['message'] = "Login to continue...";
    header('Location: login.php');
    exit();
}
?>
