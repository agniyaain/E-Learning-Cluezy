<?php
session_start();
include "koneksi.php";
include "sidebar.php";

// HANDLE AJAX REQUEST
if (isset($_POST['ajax']) && $_POST['ajax'] == "1") {
    $keyword = mysqli_real_escape_string($koneksi, $_POST['keyword']);

    $query = "SELECT * FROM catatan 
              WHERE judul LIKE '%$keyword%' 
              OR id_note LIKE '%$keyword%' 
              OR deskripsi LIKE '%$keyword%' 
              ORDER BY id_note ASC";

    $data = mysqli_query($koneksi, $query);

    // Start table with responsive container
    echo '<div class="table-container">';
    echo '<table class="table-stack">';
    echo '<thead>
            <tr>
                <th>ID</th>
                <th>Isi</th>
                <th>Judul</th>
                <th>Deskripsi</th>
                <th>ACTION</th>
            </tr>
          </thead>
          <tbody>';

    while ($dt = mysqli_fetch_assoc($data)) {
        $files = !empty($dt['isi']) ? explode(",", $dt['isi']) : [];
        $preview = '';

        if (!empty($files)) {
            $firstFile = $files[0];
            $ext = strtolower(pathinfo($firstFile, PATHINFO_EXTENSION));
            if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif'])) {
                $preview = "<img src='../assets/uploads/" . $firstFile . "' alt='Preview'>";
            } else {
                $preview = "<div class='placeholder'><i class='bi bi-file-earmark'></i> File</div>";
            }
        } else {
            $preview = "<div class='placeholder'><i class='bi bi-sticky'></i> No File</div>";
        }

        echo '<tr>';
        echo '<td data-label="ID">' . $dt['id_note'] . '</td>';
        echo '<td data-label="Isi">' . $preview . '</td>';
        echo '<td data-label="Judul">' . $dt['judul'] . '</td>';
        echo '<td data-label="Deskripsi">' . $dt['deskripsi'] . '</td>';
        echo '<td data-label="ACTION">
                <div class="action-buttons">
                    <a href="edit_notedas.php?id_note=' . $dt['id_note'] . '" class="btn-table btn-edit">
                        <i class="bi bi-pencil"></i> EDIT
                    </a>
                    <a href="delete_notedas.php?id_note=' . $dt['id_note'] . '" 
                       class="btn-table btn-delete"
                       onclick="return confirm(\'Apa anda yakin menghapus note ' . $dt['judul'] . '?\')">
                        <i class="bi bi-trash"></i> DELETE
                    </a>
                </div>
              </td>';
        echo '</tr>';
    }

    echo '</tbody></table></div>';
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Note Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/css/notedash.css">
</head>

<body>
    <main class="content">
        <div class="container">
            <h1><i class="bi bi-journal"></i> Data Note</h1>
            <hr>

            <div class="table-controls">
                <div class="search-box">
                    <input type="text" id="cari" placeholder="Cari note...">
                    <i class="bi bi-search"></i>
                </div>
                <a href="tambah_notedash.php" class="tambah">
                    <i class="bi bi-plus-circle"></i> Tambah Note
                </a>
            </div>

            <div class="table-container">
                <table id="tabel-note" class="table-stack">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Isi</th>
                            <th>Judul</th>
                            <th>Deskripsi</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include "koneksi.php";
                        $query = "SELECT * FROM catatan";
                        $data = mysqli_query($koneksi, $query);

                        if (mysqli_num_rows($data) > 0) {
                            while ($dt = mysqli_fetch_assoc($data)) {
                                $files = !empty($dt['isi']) ? explode(",", $dt['isi']) : [];
                                $preview = '';

                                if (!empty($files)) {
                                    $firstFile = $files[0];
                                    $ext = strtolower(pathinfo($firstFile, PATHINFO_EXTENSION));
                                    if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif'])) {
                                        $preview = "<img src='../assets/uploads/" . $firstFile . "' alt='Preview'>";
                                    } else {
                                        $preview = "<div class='placeholder'><i class='bi bi-file-earmark'></i> File</div>";
                                    }
                                } else {
                                    $preview = "<div class='placeholder'><i class='bi bi-sticky'></i> No File</div>";
                                }

                                echo '<tr>';
                                echo '<td data-label="ID">' . $dt['id_note'] . '</td>';
                                echo '<td data-label="Isi">' . $preview . '</td>';
                                echo '<td data-label="Judul">' . $dt['judul'] . '</td>';
                                echo '<td data-label="Deskripsi">' . $dt['deskripsi'] . '</td>';
                                echo '<td data-label="ACTION">
                                            <div class="action-buttons">
                                                <a href="edit_notedas.php?id_note=' . $dt['id_note'] . '" class="btn-table btn-edit">
                                                    <i class="bi bi-pencil"></i> EDIT
                                                </a>
                                                <a href="delete_notedas.php?id_note=' . $dt['id_note'] . '" 
                                                   class="btn-table btn-delete"
                                                   onclick="return confirm(\'Apa anda yakin menghapus note ' . $dt['judul'] . '?\')">
                                                    <i class="bi bi-trash"></i> DELETE
                                                </a>
                                            </div>
                                          </td>';
                                echo '</tr>';
                            }
                        } else {
                            echo '<tr><td colspan="5" class="no-data">Tidak ada data note</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#cari").keyup(function() {
                var keyword = $(this).val();
                $.ajax({
                    url: "note_dash.php",
                    type: "POST",
                    data: {
                        ajax: "1",
                        keyword: keyword
                    },
                    beforeSend: function() {
                        $("#tabel-note").html('<div class="text-center p-4"><div class="loading"></div> Mencari...</div>');
                    },
                    success: function(data) {
                        $("#tabel-note").html(data);
                    },
                    error: function() {
                        $("#tabel-note").html('<div class="no-data">Terjadi kesalahan saat mencari data</div>');
                    }
                });
            });
        });
    </script>
</body>

</html>