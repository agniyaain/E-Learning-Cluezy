<?php
session_start();
include "koneksi.php";

if (! isset($_SESSION['id_user'])) {
    header("Location: login.php");
    exit;
}

if (! isset($_GET['id_quiz'])) {
    die("Quiz tidak ditemukan");
}

$id_quiz = $_GET['id_quiz'];

function generateCode($length = 6)
{
    $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $code  = '';
    for ($i = 0; $i < $length; $i++) {
        $code .= $chars[rand(0, strlen($chars) - 1)];
    }
    return $code;
}

$kode  = generateCode();
$check = mysqli_query($koneksi, "SELECT * FROM quiz_session WHERE kode_session='$kode'");
while (mysqli_num_rows($check) > 0) {
    $kode  = generateCode();
    $check = mysqli_query($koneksi, "SELECT * FROM quiz_session WHERE kode_session='$kode'");
}

mysqli_query($koneksi, "INSERT INTO quiz_session (id_quiz, kode_session) VALUES ('$id_quiz', '$kode')");
$id_session = mysqli_insert_id($koneksi);

header("Location: session_lobby.php?id_session=$id_session");
exit;
