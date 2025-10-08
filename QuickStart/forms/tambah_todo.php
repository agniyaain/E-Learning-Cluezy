<?php
include "koneksi.php";
session_start();

if (! isset($_SESSION['id_user'])) {
    die("User belum login");
}

$id_user  = $_SESSION['id_user'];
$kegiatan = $_POST['kegiatan'] ?? '';
$status   = $_POST['status'] ?? 'pending'; // default kalau form gak ngirim

if ($kegiatan == '') {
    die("<script>alert('Kegiatan tidak boleh kosong!'); window.location.href='todolist.php';</script>");
}

$sql = "INSERT INTO to_do_list (id_user, status, kegiatan)
        VALUES ('$id_user', '$status', '$kegiatan')";
$result = mysqli_query($koneksi, $sql);

if ($result) {
    echo "<script>alert('Todo berhasil ditambahkan'); window.location.href='todolist.php';</script>";
} else {
    echo "Error: " . mysqli_error($koneksi);
}
