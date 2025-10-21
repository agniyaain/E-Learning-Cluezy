<?php
session_start();
include "koneksi.php";

$id_session = $_GET['id_session'] ?? 0;

// Ambil data session
$session = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM quiz_session WHERE id_session='$id_session'"));
if (! $session) {
    die("Session tidak ditemukan");
}

// Cek apakah user adalah owner
if ($session['id_user'] != $_SESSION['id_user']) {
    die("Hanya owner yang bisa mengakhiri quiz");
}

// Update status session menjadi 'finished'
mysqli_query($koneksi, "UPDATE quiz_session SET status='ended' WHERE id_session='$id_session'");

// Redirect kembali ke lobby
header("Location: session_lobby.php?id_session=$id_session");
exit;
