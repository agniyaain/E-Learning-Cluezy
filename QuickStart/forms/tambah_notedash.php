<?php
    session_start();
    // if (! isset($_SESSION['id_user'])) {
    //     header("Location: login.php");
    //     exit;
    // }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Note</title>
    <!-- <link rel="stylesheet" href="../assets/css/style.css"> -->
      <!-- Favicons -->
   <link href="../assets/img/cluezy-about.png" rel="icon">
</head>
<body>

<div class="container">
    <h1>Tambah Note</h1>
    <hr>
    <form action="simpan_notedash.php" method="post" enctype="multipart/form-data">
        <table>
            <tr>
                <td width="150px">Judul</td>
                <td><input type="text" name="judul" required></td>
            </tr>
            <tr>
                <td>Deskripsi</td>
                <td><input type="text" name="deskripsi" required></td>
            </tr>
            <tr>
                <td>File / Catatan</td>
                <td><input type="file" name="file[]" multiple accept=".jpg,.jpeg,.png,.gif,.pdf,.doc,.docx"></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="submit" value="SUBMIT" class="submit">
                    <input type="reset" value="RESET" class="batal">
                </td>
            </tr>
        </table>
    </form>
</div>
</body>
</html>
