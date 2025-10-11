<?php
include "koneksi.php";

$id_session = $_GET['id_session'] ?? 0;
mysqli_query($koneksi, "UPDATE quiz_session SET status='running' WHERE id_session='$id_session'");
header("Location: session_quiz.php?id_session=$id_session");
exit;
$id_quiz = $_GET['id_quiz'] ?? 0;
$query   = "SELECT * FROM quiz WHERE id_quiz = '$id_quiz'";
$result  = mysqli_query($koneksi, $query);
$quiz    = mysqli_fetch_assoc($result);

if (! $quiz) {
    die("Quiz not found");
}

$query2  = "SELECT * FROM soal WHERE id_quiz= '$id_quiz'";
$result2 = mysqli_query($koneksi, $query2);
$soal    = mysqli_fetch_all($result2, MYSQLI_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['jawaban_user'] = $_POST['jawaban_user'] ?? [];
    $_SESSION['id_quiz']      = $id_quiz;
    header("Location: hasil_quiz.php");
    exit;
}
