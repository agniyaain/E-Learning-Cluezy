<?php
include "koneksi.php";
$id_user = $_GET['id_user'];
$query   = "DELETE FROM user WHERE id_user=$id_user";
$result  = mysqli_query($koneksi, $query);

if ($result) {
    echo '<script>
        window.location.href="user_dash.php";
        alert("Hapus user sukses");
    </script>';
} else {
    echo '<script>
        window.location.href="user_dash.php";
        alert("Hapus user gagal");
    </script>';
}
