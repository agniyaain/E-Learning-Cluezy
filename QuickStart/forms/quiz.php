<?php
    session_start();
    include "koneksi.php";

    $search  = $_GET['search'] ?? '';
    $keyword = "%" . $search . "%";

    $query  = "SELECT * FROM quiz WHERE judul LIKE '$keyword' OR deskripsi LIKE '$keyword'";
    $result = mysqli_query($koneksi, $query);
    $quiz   = mysqli_fetch_assoc($result);
?>
<?php include "header.php";
include "navigasi.php"; ?>
    <!-- Navbar -->
    <div class="quiz">
    <div class="container py-4">
        <h2 class="text-center fw-bold mb-4">Quiz</h2>

        <!-- Search + Make Quiz -->
        <form class="d-flex justify-content-center align-items-center gap-2 mb-4" method="get">
            <input type="text" name="search" class="form-control search-bar" placeholder="Search quiz" value="<?php echo($search) ?>">
            <a href="tambah_quiz.php" class="btn btn-primary">Make Quiz</a>

        </form>
        <div class="text-center mb-3">
    <a href="join_session.php" class="btn btn-success">Join via Code</a>
</div>


        <!-- Quiz Grid -->
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-3 quiz-grid">
            <?php while ($row = $result->fetch_assoc()) {?>
                <div class="col">
                    <div class="card">
                        <a href="detail_quiz.php?id_quiz=<?php echo $row['id_quiz'] ?>" class="stretched-link text-dark text-decoration-none">
                            <div class="text-center">
                                <h6 class="fw-bold mb-1"><?php echo($row['judul']) ?></h6>
                                <small class="text-muted d-block text-truncate"><?php echo($row['deskripsi']) ?></small>
                            </div>
                        </a>
                    </div>
                </div>
            <?php }?>

            <?php if ($result->num_rows == 0) {?>
                <p class="text-center text-muted">No quizzes found.</p>
            <?php }?>
        </div>
    </div>
    </div>
</body>
<?php include "footer.php"; ?>
</html>
