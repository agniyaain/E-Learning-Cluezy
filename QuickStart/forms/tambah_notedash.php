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
                <h2 class="fw-bold mb-4">Tambah Note Baru</h2>
                <form action="simpan_notedash.php" method="post" enctype="multipart/form-data">
                    <!-- Judul Field -->
                    <div class="form-group mb-3">
                        <label class="form-label">Judul</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-card-heading"></i></span>
                            <input type="text" class="form-control" name="judul" placeholder="Enter Judul" required>
                        </div>
                    </div>

                    <!-- Deskripsi Field -->
                    <div class="form-group mb-3">
                        <label class="form-label">Deskripsi</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-text-paragraph"></i></span>
                            <input type="text" class="form-control" name="deskripsi" placeholder="Enter Deskripsi" required>
                        </div>
                    </div>

                    <!-- File Field -->
                    <div class="form-group mb-4">
                        <label class="form-label">File / Catatan</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-file-earmark"></i></span>
                            <input type="file" class="form-control" name="file[]" multiple accept=".jpg,.jpeg,.png,.gif,.pdf,.doc,.docx">
                        </div>
                        <small class="form-text text-muted">Anda dapat memilih multiple file (jpg, png, gif, pdf, doc, docx)</small>
                    </div>

                    <!-- Buttons -->
                    <div class="form-group button-group">
                        <button type="submit" class="btn submit">SUBMIT</button>
                        <button type="reset" class="btn batal">RESET</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>