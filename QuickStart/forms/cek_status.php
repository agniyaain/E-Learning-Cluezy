<?php
include "koneksi.php";
$id_session = $_GET['id_session'];
$result     = mysqli_query($koneksi, "SELECT status FROM quiz_session WHERE id_session='$id_session'");
$row        = mysqli_fetch_assoc($result);
echo json_encode($row);
