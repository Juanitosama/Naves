<?php
session_start();

if (!isset($_SESSION['loggedin'])) {
    header("Location: login.php");
    exit;
}

if (isset($_SESSION['loggedin']) && time() - $_SESSION['last_active'] > 300) {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit;
}

if (isset($_SESSION['loggedin'])) {
    $_SESSION['last_active'] = time();
}
?>