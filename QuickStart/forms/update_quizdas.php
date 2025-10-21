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
    $judul       = mysqli_real_escape_string($koneksi, $_POST['judul']);
    $deskripsi   = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);
    $jumlah_soal = intval($_POST['jumlah_soal']);

    // Validasi
    if (empty($judul)) {
        $_SESSION['error_message'] = "Judul tidak boleh kosong!";
        header("Location: edit_quizdas.php?id_quiz=" . $id_quiz);
        exit;
    }

    if ($jumlah_soal == 0) {
        $_SESSION['error_message'] = "Quiz harus memiliki setidaknya 1 soal!";
        header("Location: edit_quizdas.php?id_quiz=" . $id_quiz);
        exit;
    }

    // Debug info
    error_log("Updating quiz: id_quiz=$id_quiz, judul=$judul, jumlah_soal=$jumlah_soal");

    // Update data quiz
    $update = "UPDATE quiz SET
                judul = '$judul',
                deskripsi = '$deskripsi',
                jumlah_soal = '$jumlah_soal'
               WHERE id_quiz = '$id_quiz'";

    if (mysqli_query($koneksi, $update)) {
        error_log("Quiz updated successfully");

        // Hapus semua soal lama
        $delete = "DELETE FROM soal WHERE id_quiz = '$id_quiz'";
        mysqli_query($koneksi, $delete);
        error_log("Old questions deleted");

        // Simpan soal baru
        if (isset($_POST['soal']) && is_array($_POST['soal']) && count($_POST['soal']) > 0) {
            $soalCount = 0;
            foreach ($_POST['soal'] as $s) {
                $soal    = mysqli_real_escape_string($koneksi, $s['soal']);
                $a       = mysqli_real_escape_string($koneksi, $s['a']);
                $b       = mysqli_real_escape_string($koneksi, $s['b']);
                $c       = mysqli_real_escape_string($koneksi, $s['c']);
                $d       = mysqli_real_escape_string($koneksi, $s['d']);
                $jawaban = mysqli_real_escape_string($koneksi, $s['jawaban_benar']);

                // Skip jika soal kosong
                if (empty($soal)) {
                    continue;
                }

                $insert = "INSERT INTO soal (id_quiz, soal, pilihan_a, pilihan_b, pilihan_c, pilihan_d, jawaban_benar)
                           VALUES ('$id_quiz', '$soal', '$a', '$b', '$c', '$d', '$jawaban')";

                if (mysqli_query($koneksi, $insert)) {
                    $soalCount++;
                } else {
                    error_log("Error inserting question: " . mysqli_error($koneksi));
                }
            }
            error_log("Inserted $soalCount new questions");
        }

        $_SESSION['success_message'] = "Quiz berhasil diperbarui!";
    } else {
        error_log("Error updating quiz: " . mysqli_error($koneksi));
        $_SESSION['error_message'] = "Gagal memperbarui quiz: " . mysqli_error($koneksi);
    }

    header("Location: quiz_dash.php");
    exit;
} else {
    header("Location: quiz_dash.php");
    exit;
}
