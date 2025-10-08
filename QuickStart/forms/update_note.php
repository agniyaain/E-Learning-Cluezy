<?php
include "koneksi.php";

session_start();
if (! isset($_SESSION['id_user'])) {
    die("User belum login!");
}
$id_user = $_SESSION['id_user'];

$id_note   = $_POST['id_note'];
$judul     = $_POST['judul'];
$deskripsi = $_POST['deskripsi'];

// Ambil file lama
$queryOld  = "SELECT isi FROM catatan WHERE id_note = '$id_note'";
$resultOld = mysqli_query($koneksi, $queryOld);
$rowOld    = mysqli_fetch_assoc($resultOld);
$oldFiles  = $rowOld ? $rowOld['isi'] : '';

$uploadedFiles = [];

// Kalau ada file baru
if (! empty($_FILES['file']['name'][0])) {
    $uploadDir = "../assets/uploads/";

    foreach ($_FILES['file']['name'] as $key => $name) {
        $tmpName = $_FILES['file']['tmp_name'][$key];
        $error   = $_FILES['file']['error'][$key];

        if ($error === UPLOAD_ERR_OK) {
            $newName = time() . "_" . basename($name);
            $target  = $uploadDir . $newName;

            if (move_uploaded_file($tmpName, $target)) {
                $uploadedFiles[] = $newName;
            }
        }
    }

    $isi = implode(",", $uploadedFiles); //menggabungkan elemen-elemen array jadi satu string
} else {
    $isi = $oldFiles;
}

$query = "UPDATE catatan
          SET id_user = '$id_user',
              judul = '$judul',
              deskripsi = '$deskripsi',
              isi = '$isi'
          WHERE id_note = '$id_note'";

$result = mysqli_query($koneksi, $query);

if ($result) {
    echo '<script>
            alert("Note berhasil diperbarui!");
            window.location.href="detail_note.php?id_note=' . $id_note . '";
          </script>';
} else {
    echo '<script>
            alert("Gagal memperbarui note!");
            window.location.href="edit_note.php?id_note=' . $id_note . '";
          </script>';
}
