<?php
include "koneksi.php";

if (isset($_GET['id_quiz'])) {
    $id_quiz = intval($_GET['id_quiz']);

    // hapus soal dulu
    $koneksi->query("DELETE FROM soal WHERE id_quiz = $id_quiz");

    // baru hapus quiz
    $koneksi->query("DELETE FROM quiz WHERE id_quiz = $id_quiz");

    echo '<script>
        window.location.href="quiz_dash.php";
        alert("Hapus data berhasil");
    </script>';
    exit();
} else {
    echo "ID quiz tidak ditemukan";
}
