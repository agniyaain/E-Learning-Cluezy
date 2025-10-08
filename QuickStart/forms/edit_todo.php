<?php
    // session_start();
    // if (! isset($_SESSION['username'])) {
    //     header("Location: index.html");
    // }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit To Do</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
      <!-- Favicons -->
   <link href="../assets/img/cluezy-about.png" rel="icon">
   <link rel="stylesheet" href="../assets/css/edit_todo.css">
    <style>
        
    </style>
</head>

<body>


    <?php
        $id_todo = $_GET['id_todo'];
        include "koneksi.php";

        $query  = "select * from to_do_list where id_todo=$id_todo";
        $result = mysqli_query($koneksi, $query);
        $data   = mysqli_fetch_assoc($result);
    ?>

    <div class="card p-4" style="width: 400px;">
        <div class="card-header">
            Edit To Do
        </div>
        <div class="card-body">
            <form action="simpan_todo.php" method="post">
                <input type="hidden" name="id_todo" value="<?php echo $data['id_todo']; ?>">

                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-select">
                        <?php
                            $query  = "select * from status_todo ORDER BY FIELD(status, 'Not Yet', 'Doing', 'Done')";
                            $result = mysqli_query($koneksi, $query);
                            while ($d = mysqli_fetch_assoc($result)) {
                                echo "<option value='" . $d['status'] . "' " . (($d['status'] == $data['status']) ? 'selected' : '') . ">";
                                echo $d['status'];
                                echo "</option>";
                            }
                        ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="kegiatan" class="form-label">Kegiatan</label>
                    <input type="text" name="kegiatan" id="kegiatan" value="<?php echo $data['kegiatan']; ?>" class="form-control">
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-submit">SUBMIT</button>
                    <a href="todolist.php" class="btn btn-cancel">BATAL</a>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
