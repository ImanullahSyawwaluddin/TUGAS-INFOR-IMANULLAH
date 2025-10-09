<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

echo "Selamat datang, " . $_SESSION['user'] . "!<br>";
echo "Status kamu: " . $_SESSION['status'];
?>