<?php
include "koneksi.php";

$id_note   = $_POST['id_note'];
$isi       = $_POST['isi'];
$judul     = $_POST['judul'];
$deskripsi = $_POST['deskripsi'];

$query = "update catatan set isi='$isi', judul='$judul', deskripsi= '$deskripsi' where id_note=$id_note ";

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
