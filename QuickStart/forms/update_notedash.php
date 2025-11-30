<?php
include "koneksi.php";

$id_note   = $_POST['id_note'];
$isi       = $_POST['isi'];
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

$query = "update catatan set isi='$fileList', judul='$judul', deskripsi= '$deskripsi' where id_note=$id_note ";

//echo $query;
$result = mysqli_query($koneksi, $query);
if ($result) {
    echo '<script>

                    alert("Update note sukses!");
                    window.location.href="note_dash.php";
                </script>';
    //header("Location: mahasiswa.php");
} else {
    echo '<script>

                    alert("Update note gagal");
                     window.location.href="note_dash.php";
                </script>';
    //header("Location: mahasiswa.php");
}
