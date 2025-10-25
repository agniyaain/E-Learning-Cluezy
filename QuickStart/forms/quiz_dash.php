<?php
    include "koneksi.php";
    include "sidebar.php";

    session_start();

    if (isset($_POST['ajax']) && $_POST['ajax'] == "1") {
        $keyword = mysqli_real_escape_string($koneksi, $_POST['keyword']);

        $query = "select * from quiz
                            WHERE judul LIKE '%$keyword%'
                            OR id_quiz LIKE '%$keyword%'
                            OR deskripsi LIKE '%$keyword%'
                            OR jumlah_soal LIKE '%$keyword%'
                            ORDER BY id_quiz ASC";

        $data = mysqli_query($koneksi, $query);

        echo "<table>
            <tr>
                <th>ID</th>
                <th>Judul</th>
                <th>Dekripsi</th>
                <th>Jumlah Soal</th>
                <th>ACTION</th>
            </tr>";

        while ($dt = mysqli_fetch_assoc($data)) {
            echo "<tr>";
            echo "<td>" . $dt['id_quiz'] . "</td>";
            echo "<td>" . $dt['judul'] . "</td>";
            echo "<td>" . $dt['deskripsi'] . "</td>";
            echo "<td>", $dt['jumlah_soal'] . "</td>";
            echo "<td>
                <a href ='edit_quizdas.php?id_quiz=" . $dt['id_quiz'] . "'>EDIT </a>
                <a href='delete_quizdas.php?id_quiz=" . $dt['id_quiz'] . "'
                    onclick=\"return confirm('Apa anda yakin menghapus quiz " . $dt['judul'] . "?')\">DELETE</a>
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
    <title>Quiz Dashboard</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
        <link rel="stylesheet" href="../assets/css/notedash.css">

</head>
<body>
    <main class="content" style="margin-left: 16.666667%; padding: 2rem;"> <!-- 16.66% = col-2 dari 12 -->
        <div class="container">
            <h1>Data Quiz </h1>
            <hr>
            <input type="text" name="" id="cari" placeholder="Cari Quiz..">
            <a href="tambah_quizdash.php">Tambah Quiz</a><br><br>
            <table id="table-quiz">
                <tr>
                    <th>ID</th>
                    <th>Judul</th>
                    <th>Deskripsi</th>
                    <th>Jumlah Soal</th>
                    <th>ACTION</th>
                </tr>
                <?php
                    include "koneksi.php";
                    $query = "SELECT * FROM quiz";
                    $data  = mysqli_query($koneksi, $query);
                    while ($dt = mysqli_fetch_assoc($data)) {
                        echo "<tr>";
                        echo "<td>" . $dt['id_quiz'] . "</td>";
                        echo "<td>" . $dt['judul'] . "</td>";
                        echo "<td>" . $dt['deskripsi'] . "</td>";
                        echo "<td>" . $dt['jumlah_soal'] . "</td>";
                        echo "<td> <a href ='edit_quizdas.php?id_quiz=" . $dt['id_quiz'] . "'>EDIT </a>";
                    ?>

<a href="delete_quizdas.php?id_quiz=<?php echo $dt['id_quiz']; ?>"
                    onclick="return confirm('Apa anda yakin menghapus quiz                                                                           <?php echo $dt['judul']; ?>?');">
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
                        url:"quiz_dash.php",
                        type: "POST",
                        data: {
                            ajax: "1",
                            keyword: keyword
                        },
                        success: function(data){
                            $("#table-quiz").html(data);
                        }
                    });
                });
            });
        </script>
</body>
</html>

