<?php
    session_start();
    include "koneksi.php";

    // Pastikan user sudah login
    if (! isset($_SESSION['id_user'])) {
        header("Location: login.php");
        exit;
    }

    // Cek id_note
    if (! isset($_GET['id_note'])) {
        echo "ID Note tidak ditemukan.";
        exit;
    }

    $id_note = intval($_GET['id_note']);

    // Ambil data note
    $query  = "SELECT * FROM catatan WHERE id_note = $id_note";
    $result = mysqli_query($koneksi, $query);
    $data   = mysqli_fetch_assoc($result);

    if (! $data) {
        echo "Note tidak ditemukan.";
        exit;
    }
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Note</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="../assets/img/cluezy-about.png" rel="icon">
</head>
<body>


<div class="container">
    <h1>Edit Note</h1>
    <hr>
    <form action="update_note.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id_note" value="<?php echo $data['id_note']; ?>">

        <table>
            <tr>
                <td width="150px">Judul</td>
                <td><input type="text" name="judul" value="<?php echo htmlspecialchars($data['judul']); ?>" required></td>
            </tr>
            <tr>
                <td>Deskripsi</td>
                <td><input type="text" name="deskripsi" value="<?php echo htmlspecialchars($data['deskripsi']); ?>" required></td>
            </tr>
            <tr>
                <td>File Saat Ini</td>
                <td>
                    <?php
                        if (! empty($data['isi'])) {
                            $files = explode(",", $data['isi']);
                            foreach ($files as $file) {
                                echo "<a href='../assets/uploads/$file' target='_blank'>$file</a><br>";
                            }
                        } else {
                            echo "Tidak ada file";
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td>Upload File Baru</td>
                <td><input type="file" name="file[]" multiple accept=".jpg,.jpeg,.png,.gif,.pdf,.doc,.docx"></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="submit" value="UPDATE" class="submit">
                    <a href="note.php" class="batal">BATAL</a>
                </td>
            </tr>
        </table>
    </form>
</div>
</body>
</html>
