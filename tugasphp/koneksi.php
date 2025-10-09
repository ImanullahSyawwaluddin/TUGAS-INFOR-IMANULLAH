<?php
$host = "tugasinformanics-informatikamanics.l.aivencloud.com";
$user = "avnadmin";
$pass = "AVNS_82aKeks69pY3oCwm-Q2";
$db   = "dbtugasreal";

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
