<?php
session_start();
include "koneksi.php";

if (! isset($_SESSION['id_user'])) {
    header("Location: login.php");
    exit;
}

$id_user = $_SESSION['id_user'];
$success = false;
$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $judul       = $_POST['judul'] ?? '';
    $deskripsi   = $_POST['deskripsi'] ?? '';
    $jumlah_soal = $_POST['jumlah_soal'] ?? 0;

    if (empty($judul)) {
        $message = "Judul quiz tidak boleh kosong!";
    } elseif ($jumlah_soal <= 0) {
        $message = "Jumlah soal harus lebih dari 0!";
    } else {
        // Insert quiz baru langsung dengan query biasa
        $insert_quiz = "INSERT INTO quiz (id_user, judul, deskripsi, jumlah_soal)
                        VALUES ('$id_user', '$judul', '$deskripsi', '$jumlah_soal')";
        $result = mysqli_query($koneksi, $insert_quiz);

        if ($result) {
            $id_quiz = mysqli_insert_id($koneksi);

            // Insert soal-soalnya
            if (isset($_POST['soal']) && is_array($_POST['soal'])) {
                foreach ($_POST['soal'] as $s) {
                    $soal_text = $s['soal'];
                    $a         = $s['a'];
                    $b         = $s['b'];
                    $c         = $s['c'];
                    $d         = $s['d'];
                    $jawaban   = $s['jawaban_benar'];

                    $query_soal = "INSERT INTO soal (id_quiz, soal, pilihan_a, pilihan_b, pilihan_c, pilihan_d, jawaban_benar)
                                   VALUES ('$id_quiz', '$soal_text', '$a', '$b', '$c', '$d', '$jawaban')";
                    mysqli_query($koneksi, $query_soal);
                }
            }

            $success = true;
            $message = "Quiz berhasil dibuat!";
        } else {
            $message = "Gagal membuat quiz: " . mysqli_error($koneksi);
        }
    }
}

// Redirect
if ($success) {
    $_SESSION['success_message'] = $message;
    header("Location: quiz_dash.php");
} else {
    $_SESSION['error_message'] = $message;
    header("Location: tambah_quizdash.php");
}
exit;
