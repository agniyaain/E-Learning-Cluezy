<?php
include "koneksi.php";

if (isset($_GET['id_quiz'])) {
    $id_quiz = intval($_GET['id_quiz']);

    // ambil semua id_session yang terkait dengan quiz ini
    $sessions = $koneksi->query("SELECT id_session FROM quiz_session WHERE id_quiz = $id_quiz");

    // hapus dulu user_session yang berkaitan dengan tiap session
    while ($row = $sessions->fetch_assoc()) {
        $id_session = $row['id_session'];
        $koneksi->query("DELETE FROM user_session WHERE id_session = $id_session");
    }

    // hapus quiz_session yang terkait
    $koneksi->query("DELETE FROM quiz_session WHERE id_quiz = $id_quiz");

    // hapus soal yang terkait
    $koneksi->query("DELETE FROM soal WHERE id_quiz = $id_quiz");

    // terakhir hapus quiz-nya
    $koneksi->query("DELETE FROM quiz WHERE id_quiz = $id_quiz");

    echo '<script>
        alert("Hapus data berhasil");
        window.location.href="quiz_dash.php";
    </script>';
    exit();
} else {
    echo "ID quiz tidak ditemukan";
}
