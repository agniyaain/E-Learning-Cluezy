<?php
session_start();

include "koneksi.php";
$username = $_POST['username'];
$pass     = $_POST['pass'];

$query = "select * from user where username = '" . $username . "' and pass = '" . $pass . "'";

$rows = mysqli_query($koneksi, $query);

if ($data = mysqli_fetch_assoc($rows)) {

    //echo "<br> Data ditemukan <br>";
    $_SESSION['id_user']  = $data['id_user'];
    $_SESSION['username'] = $data['username'];
    //echo "selamat datang " . $data['username'];
    header(header: "Location: Home.php");
} else {
    header('Location: login.php?p=Login gagal');
}
