<?php

include "koneksi.php";

session_start();
if (! isset($_SESSION['id_user'])) {
    die("User belum login!");
}
$id_user = $_SESSION['id_user'];

$id_user  = $_SESSION['id_user'];
$id_todo  = $_POST['id_todo'];
$status   = $_POST['status'];
$kegiatan = $_POST['kegiatan'];

var_dump($id_user, $status, $kegiatan);

$query  = "update to_do_list set id_user = '$id_user', status='$status', kegiatan='$kegiatan' where id_todo = '$id_todo'";
$result = mysqli_query($koneksi, $query);

if ($result) {
    echo '<script>
                    alert("Succesfull save edited task!");
                   window.location.href="todolist.php";
                </script>';
} else {
    echo '<script>

                    alert("Failed to save edited task");
                    window.location.href="todolist.php";
                </script>';
}
