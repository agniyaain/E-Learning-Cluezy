<?php
    session_start();
    include "koneksi.php";

    $id_user = $_SESSION['id_user'];

    if (isset($_POST['ajax']) && $_POST['ajax'] == "1") {
        $keyword = mysqli_real_escape_string($koneksi, $_POST['keyword']);

        $query = "
        SELECT * FROM quiz q
        JOIN user u ON q.id_user = u.id_user
        WHERE (q.judul LIKE '%$keyword%' OR q.deskripsi LIKE '%$keyword%')
          AND (u.role = 'admin' OR q.id_user = '$id_user')
    ";
        $result = mysqli_query($koneksi, $query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '
            <div class="col">
                <div class="card">
                    <a href="detail_quiz.php?id_quiz=' . $row['id_quiz'] . '"
                       class="stretched-link text-dark text-decoration-none">
                        <div class="text-center">
                            <h6 class="fw-bold mb-1">' . htmlspecialchars($row['judul']) . '</h6>
                            <small class="text-muted d-block text-truncate">' . htmlspecialchars($row['deskripsi']) . '</small>
                        </div>
                    </a>
                </div>
            </div>';
            }
        } else {
            echo '<p class="text-center text-muted">No quizzes found.</p>';
        }

        exit; // hentikan eksekusi karena ini request AJAX
    }
?>
<?php include "header.php"; ?>
<!-- Navbar -->
<div class="quiz">
    <div class="container py-4">
        <h2 class="text-center fw-bold mb-4">Quiz</h2>

        <!-- Search + Make Quiz -->
        <form class="d-flex justify-content-center align-items-center gap-2 mb-4" method="get">
            <input type="text" name="search" class="form-control search-bar" placeholder="Search quiz" id="searchQuiz">
            <a href="tambah_quiz.php" class="btn btn-primary">Make Quiz</a>

        </form>
        <div class="text-center mb-3">
            <a href="join_session.php" class="btn btn-success">Join via Code</a>
        </div>


        <!-- Quiz Grid -->
        <div id ="quizContainer" class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-3 quiz-grid">

            <?php
                include "koneksi.php";
                $query = "SELECT * FROM quiz";
                $data  = mysqli_query($koneksi, $query);
            while ($row = $data->fetch_assoc()) {?>
                <div class="col">
                    <div class="card">
                        <a href="detail_quiz.php?id_quiz=<?php echo $row['id_quiz'] ?>"
                            class="stretched-link text-dark text-decoration-none">
                            <div class="text-center">
                                <h6 class="fw-bold mb-1"><?php echo($row['judul']) ?></h6>
                                <small class="text-muted d-block text-truncate"><?php echo($row['deskripsi']) ?></small>
                            </div>
                        </a>
                    </div>
                </div>
            <?php }?>

            <?php if ($data->num_rows == 0) {?>
                <p class="text-center text-muted">No quizzes found.</p>
            <?php }?>
        </div>
    </div>
</div>
</body>
<?php include "footer.php"; ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function(){
    $('#searchQuiz').keyup(function(){
        var keyword = $(this).val();
        $.ajax({
            url: 'quiz.php',
            type: 'POST',
            data: {
                ajax: '1',
                keyword: keyword
            },
            success: function(data){
                $('#quizContainer').html(data);
            }
        });
    });
});
</script>

</html>