<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head><title>Menu</title></head>
<body>
<h2>Menu</h2>
<ul>
    <li><a href="operasi.php">Operasi Matematika</a></li>
    <li><a href="luas.php">Mencari Luas Bangun</a></li>
    <li><a href="logout.php">Logout</a></li>
</ul>
</body>
</html>