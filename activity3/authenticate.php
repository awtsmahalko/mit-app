<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if(!isset($_SESSION['username']) || empty($_SESSION['username'])) {
        header("location: index.php");
    }
    $username = $_SESSION['username'];