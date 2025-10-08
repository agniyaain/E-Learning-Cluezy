<?php
session_start();
include "koneksi.php";

if (! isset($_SESSION['id_user'])) {
    header("Location: login.php");
    exit;
}

$id_user = $_SESSION['id_user'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_quiz     = $_POST['id_quiz'];
    $judul       = $_POST['judul'];
    $deskripsi   = $_POST['deskripsi'];
    $jumlah_soal = $_POST['jumlah_soal'];

    if ($judul == "") {
        $_SESSION['error_message'] = "Judul tidak boleh kosong!";
        header("Location: edit_quiz.php?id_quiz=" . $id_quiz);
        exit;
    }

    // update data quiz
    $update = "UPDATE quiz SET judul='$judul', deskripsi='$deskripsi', jumlah_soal='$jumlah_soal'
               WHERE id_quiz='$id_quiz' AND id_user='$id_user'";
    mysqli_query($koneksi, $update);

    // hapus semua soal lama dulu
    mysqli_query($koneksi, "DELETE FROM soal WHERE id_quiz='$id_quiz'");

    // simpan ulang soal
    if (isset($_POST['soal']) && is_array($_POST['soal'])) {
        foreach ($_POST['soal'] as $s) {
            $soal    = $s['soal'];
            $a       = $s['a'];
            $b       = $s['b'];
            $c       = $s['c'];
            $d       = $s['d'];
            $jawaban = $s['jawaban_benar'];

            $insert = "INSERT INTO soal (id_quiz, soal, pilihan_a, pilihan_b, pilihan_c, pilihan_d, jawaban_benar)
                       VALUES ('$id_quiz', '$soal', '$a', '$b', '$c', '$d', '$jawaban')";
            mysqli_query($koneksi, $insert);
        }
    }

    $_SESSION['success_message'] = "Quiz berhasil diperbarui!";
    header("Location: quiz.php");
    exit;
}
