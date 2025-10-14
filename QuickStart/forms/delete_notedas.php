<?php
include "koneksi.php";
$id_note = $_GET['id_note'];
$query   = "DELETE FROM catatan WHERE id_note=$id_note";
$result  = mysqli_query($koneksi, $query);

if ($result) {
    echo '<script>
        window.location.href="note_dash.php";
        alert("Hapus note sukses");
    </script>';
} else {
    echo '<script>
        window.location.href="note_dash.php";
        alert("Hapus note gagal");
    </script>';
}
