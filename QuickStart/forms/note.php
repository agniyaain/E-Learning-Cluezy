<?php
    include "koneksi.php";
    // Ambil data dari tabel note dengan pencarian jika ada
    $search = isset($_GET['search']) ? $_GET['search'] : '';

    $sql = "SELECT * FROM catatan";
    if (! empty($search)) {
        $searchEscaped = $koneksi->real_escape_string($search);
        $sql .= " WHERE judul LIKE '%$searchEscaped%' OR isi LIKE '%$searchEscaped%'
                          OR deskripsi LIKE '%$searchEscaped%'";
    }

    $result = $koneksi->query($sql);
?>

<link rel="stylesheet" href="../assets/css/note.css">
  <link href="../assets/img/cluezy-about.png" rel="icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

  <?php include "navigasi.php"; ?>

  <div class="note">
  <div class="page-header">
    <h1>Cluezy Public Notes</h1>
    <p>Simpan dan kelola catatan belajar Anda dengan mudah</p>
  </div>

  <div class="search-container">
    <form method="GET" action="" class="mb-3">
      <input type="text" name="search" placeholder="Cari judul atau deskripsi..." value="<?php echo $search; ?>" />
      <button type="submit"><i class="rounded-pill fas fa-search me-2"></i>Cari</button>
    </form>
    <button onclick="window.location.href='tambah_note.php'"><i class="rounded-pill fas fa-plus me-2 rounded"></i>Tambah Note</button>
  </div>

  <div class="notes-container">
    <?php if ($result && $result->num_rows > 0): ?>
      <?php while ($row = $result->fetch_assoc()): ?>
        <?php
            $files   = ! empty($row['isi']) ? explode(",", $row['isi']) : [];
            $preview = '';
            if (! empty($files)) {
                $firstFile = $files[0];
                $ext       = strtolower(pathinfo($firstFile, PATHINFO_EXTENSION));
                if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif'])) {
                    $preview = "<img src='../assets/uploads/" . $firstFile . "' alt='Preview'>";
                } else {
                    $preview = "<div class='placeholder'><i class='fas fa-file'></i></div>";
                }
            } else {
                $preview = "<div class='placeholder'><i class='fas fa-sticky-note'></i></div>";
            }
        ?>
        <div class="note-card">
          <?php echo $preview ?>
          <div class="note-title"><?php echo $row['judul'] ?></div>
          <div class="note-description"><?php echo $row['deskripsi'] ?></div>
          <button class="btn-view" onclick="window.location.href='detail_note.php?id_note=<?php echo $row['id_note'] ?>'">
            <i class="fas fa-eye me-2"></i>View more
          </button>
        </div>
      <?php endwhile; ?>
    <?php else: ?>
      <div class="no-data">
        <i class="fas fa-search" style="font-size: 48px; margin-bottom: 15px;"></i>
        <p>Tidak ada data note ditemukan.</p>
        <?php if (! empty($search)): ?>
          <p>Try different search terms or <a href="?" style="color: var(--color-brown); font-weight: 600;">clear search</a></p>
        <?php endif; ?>
      </div>
    <?php endif; ?>
  </div>
  </div>


</body>

  <?php include "footer.php"; ?>


</html>

<?php
$koneksi->close();
?>