<?php
    include "koneksi.php";
    include "sidebar.php";
    session_start();
    //HANDLE AJAX REQUEST
    if (isset($_POST['ajax']) && $_POST['ajax'] == "1") {
        $keyword = mysqli_real_escape_string($koneksi, $_POST['keyword']);

        $query = "select * from catatan
                            WHERE judul LIKE '%$keyword%'
                            OR id_note LIKE '%$keyword%'
                            OR deskripsi LIKE '%$keyword%'
                            ORDER BY id_note ASC";

        $data = mysqli_query($koneksi, $query);

        echo "<table>
            <tr>
                <th>ID</th>
                <th>Isi</th>
                <th>Judul</th>
                <th>Deskripsi</th>
                <th>ACTION</th>
            </tr>";

        while ($dt = mysqli_fetch_assoc($data)) {
            echo "<tr>";
            echo "<td>" . $dt['id_note'] . "</td>";
            echo "<td>" . $dt['isi'] . "</td>";
            echo "<td>" . $dt['judul'] . "</td>";
            echo "<td>", $dt['deskripsi'] . "</td>";
            echo "<td>
                <a href ='edit_notedas.php?id_note=" . $dt['id_note'] . "'>EDIT | </a>
                <a href='delete_notedas.php.php?id_note=" . $dt['id_note'] . "'
                    onclick=\"return confirm('Apa anda yakin menghapus user " . $dt['judul'] . "?')\">DELETE</a>
                    </td>";
            echo "<tr>";
        }

        echo "</table>";
        exit; //menghentikan eksekusi untuk AJAX
    }
?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User</title>
        <!-- <link rel="stylesheet" href="style.css"> -->
          <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(180deg, #2c3e50 0%, #3498db 100%);
            transition: all 0.3s;
        }

        .sidebar .nav-link {
            color: #ecf0f1;
            padding: 12px 20px;
            margin: 4px 0;
            border-radius: 8px;
            transition: all 0.3s;
        }

        .sidebar .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: #ffffff;
            transform: translateX(5px);
        }

        .sidebar .nav-link.active {
            background-color: #e74c3c;
            color: #ffffff;
        }

        .sidebar .nav-link i {
            margin-right: 10px;
            font-size: 1.1rem;
         }

        .logo {
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .logo h4 {
            color: white;
            margin: 0;
            font-weight: 600;
        }

        .user-info {
            padding: 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            text-align: center;
        }

        .user-info img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            margin-bottom: 10px;
            border: 3px solid rgba(255, 255, 255, 0.2);
        }

        .user-info h6 {
            color: white;
            margin: 5px 0;
        }

        .user-info small {
            color: #bdc3c7;
        }
    </style>
    </head>
    <body>
    <main class="content" style="margin-left: 16.666667%; padding: 2rem;"> <!-- 16.66% = col-2 dari 12 -->
        <div class="container" >
            <h1>Data Note</h1>
            <hr>
            <input type="text" name="" id="cari" placeholder="Cari note..."> <br> <br>
            <table id="tabel-note">
                <tr>
                    <th>ID</th>
                    <th>Isi</th>
                    <!-- <th>User</th> -->
                    <th>Judul</th>
                    <th>Deskripsi</th>
                    <th>ACTION</th>
                </tr>
            <?php
                include "koneksi.php";
                $query = "SELECT * FROM catatan";
                $data  = mysqli_query($koneksi, $query);
                while ($dt = mysqli_fetch_assoc($data)) {

                    $files   = ! empty($dt['isi']) ? explode(",", $dt['isi']) : [];
                    $preview = '';
                    if (! empty($files)) {
                        $firstFile = $files[0];
                        $ext       = strtolower(pathinfo($firstFile, PATHINFO_EXTENSION));
                        if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif'])) {
                            $preview = "<img src='../assets/uploads/" . $firstFile . "' alt='Preview'>";
                        } else {
                            $preview = "<div class='placeholder'><i class='fas fa-file'></i>File</div>";
                        }
                    } else {
                        $preview = "<div class='placeholder'><i class='fas fa-sticky-note'></i>No File</div>";
                    }

                    echo "<tr>";
                    echo "<td>" . $dt['id_note'] . "</td>";
                    echo "<td>" . $preview . "</td>";
                    // echo "<td>" . $dt['id_user'] . "</td>";
                    echo "<td>" . $dt['judul'] . "</td>";
                    echo "<td>", $dt['deskripsi'] . "</td>";
                    echo "<td> <a href ='edit_notedas.php?id_note=" . $dt['id_note'] . "'>EDIT | </a>";
                ?>
                <a href="delete_notedas.php?id_note=<?php echo $dt['id_note']; ?>"
                    onclick="return confirm('Apa anda yakin menghapus note<?php echo $dt['judul']; ?>?');">
                    DELETE
                </a>
                <?php
                    echo "</td>";
                        echo "</tr>";
                    }
                ?>
            </table>
        </div>
    </main>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script>
            $(document).ready(function() {
                $("#cari").keyup(function(){
                    var keyword = $(this).val();
                    $.ajax({
                        url:"note_dash.php",
                        type: "POST",
                        data: {
                            ajax: "1",
                            keyword: keyword
                        },
                        success: function(data){
                            $("#tabel-note").html(data);
                        }
                    });
                });
            });
        </script>
    </body>
    </html>