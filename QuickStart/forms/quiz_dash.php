<?php
session_start();
include "koneksi.php";
include "sidebar.php";

if (isset($_POST['ajax']) && $_POST['ajax'] == "1") {
    $keyword = mysqli_real_escape_string($koneksi, $_POST['keyword']);

    $query = "SELECT * FROM quiz
              WHERE judul LIKE '%$keyword%'
              OR id_quiz LIKE '%$keyword%'
              OR deskripsi LIKE '%$keyword%'
              OR jumlah_soal LIKE '%$keyword%'
              ORDER BY id_quiz ASC";

    $data = mysqli_query($koneksi, $query);

    // PERBAIKAN: Gunakan struktur yang sama dengan bagian awal
    echo '<div class="table-container">';
    echo '<table class="table-stack">';
    echo '<thead>
            <tr>
                <th>ID</th>
                <th>Judul</th>
                <th>Deskripsi</th>
                <th>Jumlah Soal</th>
                <th>ACTION</th>
            </tr>
          </thead>
          <tbody>';

    while ($dt = mysqli_fetch_assoc($data)) {
        echo '<tr>';
        echo '<td data-label="ID">' . $dt['id_quiz'] . '</td>';
        echo '<td data-label="Judul">' . $dt['judul'] . '</td>';
        echo '<td data-label="Deskripsi">' . $dt['deskripsi'] . '</td>';
        echo '<td data-label="Jumlah Soal">' . $dt['jumlah_soal'] . '</td>';
        echo '<td data-label="ACTION">
                <div class="action-buttons">
                    <a href="edit_quizdas.php?id_quiz=' . $dt['id_quiz'] . '" class="btn-table btn-edit">
                        <i class="bi bi-pencil"></i> EDIT
                    </a>
                    <a href="delete_quizdas.php?id_quiz=' . $dt['id_quiz'] . '" 
                       class="btn-table btn-delete"
                       onclick="return confirm(\'Apa anda yakin menghapus quiz ' . $dt['judul'] . '?\')">
                        <i class="bi bi-trash"></i> DELETE
                    </a>
                </div>
              </td>';
        echo '</tr>';
    }

    echo '</tbody></table></div>';
    exit; //menghentikan eksekusi untuk AJAX
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/css/notedash.css">
</head>

<body>
    <main class="content">
        <div class="container">
            <h1><i class="bi bi-grid"></i> Data Quiz</h1>
            <hr>
            <div class="table-controls">
                <div class="search-box">
                    <input type="text" id="cari" placeholder="Cari quiz...">
                    <i class="bi bi-search"></i>
                </div>
                <a href="tambah_quizdash.php" class="tambah">
                    <i class="bi bi-plus-circle"></i> Tambah Quiz
                </a>
            </div>

            <div id="tabel-container">
                <div class="table-container">
                    <table class="table-stack">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Judul</th>
                                <th>Deskripsi</th>
                                <th>Jumlah Soal</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include "koneksi.php";
                            $query = "SELECT * FROM quiz";
                            $data  = mysqli_query($koneksi, $query);

                            if (mysqli_num_rows($data) > 0) {
                                while ($dt = mysqli_fetch_assoc($data)) {
                                    echo '<tr>';
                                    echo '<td data-label="ID">' . $dt['id_quiz'] . '</td>';
                                    echo '<td data-label="Judul">' . $dt['judul'] . '</td>';
                                    echo '<td data-label="Deskripsi">' . $dt['deskripsi'] . '</td>';
                                    echo '<td data-label="Jumlah Soal">' . $dt['jumlah_soal'] . '</td>';
                                    echo '<td data-label="ACTION">
                                            <div class="action-buttons">
                                                <a href="edit_quizdas.php?id_quiz=' . $dt['id_quiz'] . '" class="btn-table btn-edit">
                                                    <i class="bi bi-pencil"></i> EDIT
                                                </a>
                                                <a href="delete_quizdas.php?id_quiz=' . $dt['id_quiz'] . '" 
                                                   class="btn-table btn-delete"
                                                   onclick="return confirm(\'Apa anda yakin menghapus quiz ' . $dt['judul'] . '?\')">
                                                    <i class="bi bi-trash"></i> DELETE
                                                </a>
                                            </div>
                                          </td>';
                                    echo '</tr>';
                                }
                            } else {
                                echo '<tr><td colspan="5" class="no-data">Tidak ada data quiz</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#cari").keyup(function() {
                var keyword = $(this).val();
                $.ajax({
                    url: "quiz_dash.php",
                    type: "POST",
                    data: {
                        ajax: "1",
                        keyword: keyword
                    },
                    beforeSend: function() {
                        $("#tabel-container").html('<div class="text-center p-4"><div class="loading"></div> Mencari...</div>');
                    },
                    success: function(data) {
                        $("#tabel-container").html(data);
                    },
                    error: function() {
                        $("#tabel-container").html('<div class="no-data">Terjadi kesalahan saat mencari data</div>');
                    }
                });
            });
        });
    </script>
</body>

</html>