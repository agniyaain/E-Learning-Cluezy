<?php
include "koneksi.php";
session_start();

// Debug: Cek session
var_dump($_SESSION);
if (!isset($_SESSION['id_user']) || empty($_SESSION['id_user'])) {
    echo '<script>
            alert("Silakan login terlebih dahulu.");
            window.location.href="login.php";
          </script>';
    exit;
}

// Pastikan id_user valid
$id_user = mysqli_real_escape_string($koneksi, $_SESSION['id_user']);

// Verifikasi user exists di database
$check_user = mysqli_query($koneksi, "SELECT id_user FROM user WHERE id_user = '$id_user'");
if (mysqli_num_rows($check_user) == 0) {
    echo '<script>
            alert("User tidak valid. Silakan login kembali.");
            window.location.href="login.php";
          </script>';
    exit;
}


$id_user   = $_SESSION['id_user']; // kalau belum login, default 0
$judul     = $_POST['judul'];
$deskripsi = $_POST['deskripsi'];

$uploadDir = __DIR__ . "/../assets/uploads/";

// buat folder kalau belum ada
if (! is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

$files = [];
if (! empty($_FILES['file']['name'][0])) {
    foreach ($_FILES['file']['name'] as $key => $name) {
        if ($_FILES['file']['error'][$key] === UPLOAD_ERR_OK) {
            $tmp     = $_FILES['file']['tmp_name'][$key];
            $newName = time() . "_" . preg_replace("/[^A-Za-z0-9.\-_]/", "_", $name);
            $dest    = $uploadDir . $newName;

            if (move_uploaded_file($tmp, $dest)) {
                $files[] = $newName;
            }
        }
    }
}

$fileList = implode(",", $files);

$query = "INSERT INTO catatan (id_user, judul, isi, deskripsi)
           VALUES ('$id_user', '$judul', '$fileList', '$deskripsi')";
$result = mysqli_query($koneksi, $query);

if ($result) {
    echo '<script>
            alert("Simpan data sukses!");
            window.location.href="note_dash.php";
          </script>';
} else {
    echo '<script>
            alert("Simpan data gagal: ' . mysqli_error($koneksi) . '");
            window.location.href="note_dash.php";
          </script>';
}
