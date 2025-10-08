<?php
include "koneksi.php";
$id_todo = $_GET['id_todo'];
$query   = "DELETE FROM to_do_list WHERE id_todo=$id_todo";
$result  = mysqli_query($koneksi, $query);

if ($result) {
    echo '<script>
        window.location.href="todolist.php";
        alert("Hapus data sukses");
    </script>';
} else {
    echo '<script>
        window.location.href="todolist.php";
        alert("Hapus data gagal");
    </script>';
}
