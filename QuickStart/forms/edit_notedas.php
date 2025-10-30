<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Note</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/css/user_dash.css">
    <!-- Favicons -->
    <link href="../assets/img/cluezy-about.png" rel="icon">
</head>

<body>

    <div class="container signup-container">
        <div class="row signup-box w-100">
            <!-- Form Section -->
            <div class="col-12 signup-form">
                <h2 class="fw-bold mb-4">Edit Note</h2>

                <?php
                $id_note = $_GET['id_note'];
                include "koneksi.php";

                $query  = "SELECT * FROM catatan WHERE id_note=$id_note";
                $result = mysqli_query($koneksi, $query);
                $data   = mysqli_fetch_assoc($result);
                ?>

                <form action="update_notedash.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id_note" value="<?php echo $data['id_note']; ?>">

                    <!-- Judul Field -->
                    <div class="form-group mb-3">
                        <label class="form-label">Judul</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-card-heading"></i></span>
                            <input type="text" class="form-control" name="judul" value="<?php echo htmlspecialchars($data['judul']); ?>" placeholder="Enter Judul" required>
                        </div>
                    </div>

                    <!-- Deskripsi Field -->
                    <div class="form-group mb-3">
                        <label class="form-label">Deskripsi</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-text-paragraph"></i></span>
                            <input type="text" class="form-control" name="deskripsi" value="<?php echo htmlspecialchars($data['deskripsi']); ?>" placeholder="Enter Deskripsi" required>
                        </div>
                    </div>

                    <!-- File Saat Ini -->
                    <div class="form-group mb-3">
                        <label class="form-label">File Saat Ini</label>
                        <div class="current-files">
                            <?php
                            if (!empty($data['isi'])) {
                                $files = explode(",", $data['isi']);
                                foreach ($files as $file) {
                                    echo '<div class="file-item mb-2">';
                                    echo '<i class="bi bi-file-earmark me-2"></i>';
                                    echo "<a href='../assets/uploads/$file' target='_blank' class='text-decoration-none'>$file</a>";
                                    echo '</div>';
                                }
                            } else {
                                echo '<div class="text-muted">Tidak ada file</div>';
                            }
                            ?>
                        </div>
                    </div>

                    <!-- Upload File Baru -->
                    <div class="form-group mb-4">
                        <label class="form-label">Upload File Baru</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-cloud-upload"></i></span>
                            <input type="file" class="form-control" name="file[]" multiple accept=".jpg,.jpeg,.png,.gif,.pdf,.doc,.docx">
                        </div>
                        <small class="form-text text-muted">File yang diupload akan menggantikan file lama. Kosongkan jika tidak ingin mengubah file.</small>
                    </div>

                    <!-- Buttons -->
                    <div class="form-group button-group">
                        <button type="submit" class="btn submit">UPDATE</button>
                        <a href="note_dash.php" class="btn batal">BATAL</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>