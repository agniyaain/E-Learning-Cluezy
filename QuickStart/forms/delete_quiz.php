<?php
include "koneksi.php";



if (isset($_GET['id_quiz'])) {
    $id_quiz = intval($_GET['id_quiz']);

    $koneksi->query("DELETE user_session FROM user_session 
        JOIN quiz_session ON user_session.id_session = quiz_session.id_session
        WHERE quiz_session.id_quiz = $id_quiz");

    // hapus soal dulu
    $koneksi->query("DELETE FROM soal WHERE id_quiz = $id_quiz");

    // baru hapus quiz
    $koneksi->query("DELETE FROM quiz WHERE id_quiz = $id_quiz");

    header("Location: quiz.php?deleted=1");
    exit();
} else {
    echo "ID quiz tidak ditemukan";
}
