<?php
include "koneksi.php";

if (isset($_POST['login'])) {
    $user = $_POST['user'];
    $pass = $_POST['password'];

    $query = mysqli_query($koneksi, "SELECT * FROM tbl_user WHERE user='$user' AND password='$pass'");
    $data = mysqli_fetch_array($query);

    if ($data) {
        session_start();
        $_SESSION['user'] = $data['user'];
        $_SESSION['status'] = $data['status'];
        header("Location: menu.php");
    } else {
        echo "Login gagal! Username atau password salah.";
    }
}
?>

<form method="post">
    <label>Username:</label><br>
    <input type="text" name="user"><br>
    <label>Password:</label><br>
    <input type="password" name="password"><br>
    <button type="submit" name="login">Login</button>
</form>
