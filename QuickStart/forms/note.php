<?php
include "koneksi.php";
// Ambil data dari tabel note dengan pencarian jika ada
if (isset($_POST['ajax']) && $_POST['ajax'] == "1") {
  $keyword = mysqli_real_escape_string($koneksi, $_POST['keyword']);

  $query = "
        SELECT * FROM catatan
        WHERE judul LIKE '%$keyword%' 
           OR isi LIKE '%$keyword%' 
           OR deskripsi LIKE '%$keyword%'
    ";
  $result = mysqli_query($koneksi, $query);

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $files   = !empty($row['isi']) ? explode(",", $row['isi']) : [];
      $preview = '';
      if (!empty($files)) {
        $firstFile = $files[0];
        $ext = strtolower(pathinfo($firstFile, PATHINFO_EXTENSION));
        if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif'])) {
          $preview = "<img src='../assets/uploads/" . $firstFile . "' alt='Preview'>";
        } else {
          $preview = "<div class='placeholder'><i class='fas fa-file'></i></div>";
        }
      } else {
        $preview = "<div class='placeholder'><i class='fas fa-sticky-note'></i></div>";
      }

      echo '
            <div class="note-card">
                ' . $preview . '
                <div class="note-title">' . htmlspecialchars($row['judul']) . '</div>
                <div class="note-description">' . htmlspecialchars($row['deskripsi']) . '</div>
                <button class="btn-view" onclick="window.location.href=\'detail_note.php?id_note=' . $row['id_note'] . '\'">
                    <i class="fas fa-eye me-2"></i>View more
                </button>
            </div>';
    }
  } else {
    echo '
        <div class="no-data">
            <i class="fas fa-search" style="font-size: 48px; margin-bottom: 15px;"></i>
            <p>Tidak ada data note ditemukan.</p>
        </div>';
  }

  exit;
}
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
    <div class="search-bar">
      <input type="text" placeholder="search notes" id="searchNote" />
      <button onclick="window.location.href='tambah_note.php'" class="btn-make-notes">Make Notes</button>
    </div>
  </div>


  <div class="notes-container" id="noteContainer">

    <?php
    $query = "SELECT * FROM catatan";
    $result = mysqli_query($koneksi, $query);
    if ($result && $result->num_rows > 0):
    ?>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    $('#searchNote').keyup(function() {
      var keyword = $(this).val();
      $.ajax({
        url: 'note.php',
        type: 'POST',
        data: {
          ajax: '1',
          keyword: keyword
        },
        success: function(data) {
          $('#noteContainer').html(data);
        }
      });
    });
  });
</script>

<!-- <?php include "footer.php"; ?> -->


</html>

<?php
$koneksi->close();
?>