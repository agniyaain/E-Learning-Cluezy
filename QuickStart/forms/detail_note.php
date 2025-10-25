<?php
    session_start();
    include "koneksi.php";

    if (! isset($_GET['id_note'])) {
        echo "Note ID tidak ditemukan.";
        exit;
    }

    $id_note = $_GET['id_note'];

    // Query dengan join untuk mendapatkan data user
    $query = "SELECT c.*, u.username FROM catatan c
              LEFT JOIN user u ON c.id_user = u.id_user
              WHERE c.id_note = $id_note";

    $result = mysqli_query($koneksi, $query);
    $data   = mysqli_fetch_assoc($result);

    if (! $data) {
        echo "Note not found!";
        exit;
    }

    $files = ! empty($data['isi']) ? explode(",", $data['isi']) : [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Detail Note</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Comic+Neue:wght@400;700&display=swap" rel="stylesheet">
  <!-- Favicons -->
   <link href="../assets/img/cluezy-about.png" rel="icon">
    <link rel="stylesheet" href="../assets/css/det_note.css">
</head>
<body>
<?php include "navigasi.php"; ?>

<div class="container py-5">
    <div class="note-card">
        <h2><?php echo $data['judul']; ?></h2>
        <p><?php echo $data['deskripsi']; ?></p>

        <!-- Tampilkan Nama User -->
        <p><strong>Created by: </strong><?php echo($data['username'] ?? 'Unknown User'); ?></p>

        <?php if (! empty($files)) {?>
            <div class="note-files">
                <?php
                    $imageFiles = [];
                        $otherFiles = [];

                        foreach ($files as $file) {
                            $ext = (pathinfo($file, PATHINFO_EXTENSION));
                            if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif'])) {
                                $imageFiles[] = $file;
                            } else {
                                $otherFiles[] = $file;
                            }
                        }

                        // Tampilkan gambar dengan lightbox
                    foreach ($imageFiles as $index => $file) {?>
                    <img src="../assets/uploads/<?php echo $file; ?>"
                         alt="Gambar                                                                                                                                                                                                                                                                                                 <?php echo $index + 1; ?>"
                         onclick="openLightbox(this,                                                                                                                                                                                                                                                                                                                                                                                                                                 <?php echo $index; ?>)">
                <?php }

                        // Tampilkan file lainnya
                    foreach ($otherFiles as $file) {?>
                    <a href="../assets/uploads/<?php echo $file; ?>" target="_blank"><?php echo $file; ?></a>
                <?php }?>
            </div>
            <?php if (isset($_SESSION['id_user']) && $_SESSION['id_user'] == $data['id_user']) {?>
    <a href="edit_note.php?id_note=<?php echo $data['id_note']; ?>" class=" btn-back">
        <i class="fas fa-edit"></i> Edit
    </a>
    <a href="delete_note.php?id_note=<?php echo $data['id_note']; ?>"
       class=" btn-back"
       onclick="return confirm('Yakin mau hapus note ini?')">
        <i class="fas fa-trash"></i> Delete
    </a>
<?php }?>

        <?php }?>
        <a href="note.php" class="btn-back">← Back</a>
    </div>
</div>

<!-- Lightbox -->
<div id="lightbox" class="lightbox">
    <span class="close" onclick="closeLightbox()">&times;</span>
    <span class="nav-btn prev" onclick="changeImage(-1)">&#10094;</span>
    <span class="nav-btn next" onclick="changeImage(1)">&#10095;</span>
    <img class="lightbox-content" id="lightbox-img">
    <div id="lightbox-caption" class="lightbox-caption"></div>
</div>

<script>
    // Variabel global untuk lightbox
    let currentImageIndex = 0;
    const images =                                                                                                                                                 <?php echo json_encode($imageFiles); ?>;

    // Fungsi untuk membuka lightbox
    function openLightbox(element, index) {
        const lightbox = document.getElementById('lightbox');
        const lightboxImg = document.getElementById('lightbox-img');
        const caption = document.getElementById('lightbox-caption');

        currentImageIndex = index;

        lightbox.style.display = 'flex';
        lightboxImg.src = element.src;
        caption.innerHTML = element.alt;

        // Prevent body from scrolling when lightbox is open
        document.body.style.overflow = 'hidden';
    }

    // Fungsi untuk menutup lightbox
    function closeLightbox() {
        document.getElementById('lightbox').style.display = 'none';
        document.body.style.overflow = 'auto'; // Enable scrolling again
    }

    // Fungsi untuk mengganti gambar di lightbox
    function changeImage(direction) {
        currentImageIndex += direction;

        // Handle wrap-around for next/previous
        if (currentImageIndex >= images.length) {
            currentImageIndex = 0;
        } else if (currentImageIndex < 0) {
            currentImageIndex = images.length - 1;
        }

        const lightboxImg = document.getElementById('lightbox-img');
        const caption = document.getElementById('lightbox-caption');

        lightboxImg.src = '../assets/uploads/' + images[currentImageIndex];
        caption.innerHTML = 'Gambar ' + (currentImageIndex + 1);
    }

    // Tutup lightbox ketika mengklik di luar gambar
    document.getElementById('lightbox').addEventListener('click', function(e) {
        if (e.target !== document.getElementById('lightbox-img') &&
            !e.target.classList.contains('nav-btn') &&
            !e.target.classList.contains('close')) {
            closeLightbox();
        }
    });

    // Navigasi dengan keyboard
    document.addEventListener('keydown', function(e) {
        const lightbox = document.getElementById('lightbox');
        if (lightbox.style.display === 'flex') {
            if (e.key === 'Escape') {
                closeLightbox();
            } else if (e.key === 'ArrowLeft') {
                changeImage(-1);
            } else if (e.key === 'ArrowRight') {
                changeImage(1);
            }
        }
    });
</script>
</body>
</html>