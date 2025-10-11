<?php
    session_start();
    include "koneksi.php";

    $id_session = $_GET['id_session'] ?? 0;

    // Ambil data session dan quiz
    $session = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM quiz_session WHERE id_session='$id_session'"));
    if (! $session) {
        die("Session tidak ditemukan");
    }

    $id_quiz = $session['id_quiz'];

    // Update status jadi running
    mysqli_query($koneksi, "UPDATE quiz_session SET status='running' WHERE id_session='$id_session'");

    // Ambil data quiz
    $query  = "SELECT * FROM quiz WHERE id_quiz = '$id_quiz'";
    $result = mysqli_query($koneksi, $query);
    $quiz   = mysqli_fetch_assoc($result);

    if (! $quiz) {
        die("Quiz tidak ditemukan");
    }

    // Ambil semua soal
    $query2  = "SELECT * FROM soal WHERE id_quiz= '$id_quiz'";
    $result2 = mysqli_query($koneksi, $query2);
    $soal    = mysqli_fetch_all($result2, MYSQLI_ASSOC);

    // Kalau user submit jawaban
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $_SESSION['jawaban_user'] = $_POST['jawaban_user'] ?? [];
        $_SESSION['id_quiz']      = $id_quiz;
        header("Location: hasil_quiz.php");
        exit;
    }

?>

<!doctype html>
<html lang="en">
<head>
    <title>Quiz:                                                                                                                                                                                                 <?php echo($quiz['judul']) ?></title>
    <link rel="stylesheet" href="../assets/css/mulai_quiz.css">
</head>
<body>
<div class="quiz-container">
    <div class="quiz-header">
        <div class="quiz-title"><?php echo($quiz['judul']) ?></div>
    </div>

    <div class="progress-container">
        <div class="question-counter">Question <span id="current-question">1</span> of                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         <?php echo count($soal) ?></div>
        <div class="progress">
            <div class="progress-bar" role="progressbar" style="width:                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         <?php echo(1 / count($soal)) * 100 ?>%;"
                 aria-valuenow="<?php echo(1 / count($soal)) * 100 ?>" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
    </div>

    <form method="POST" id="quizForm">
        <?php foreach ($soal as $index => $q) {?>
            <div class="question-card<?php echo $index === 0 ? ' active' : '' ?>" id="q<?php echo $index ?>">
                <div class="question-text"><?php echo($q['soal']) ?></div>

                <div class="choices">
                    <?php foreach (['a', 'b', 'c', 'd'] as $choice) {
                            $choiceText = $q['pilihan_' . $choice];
                            $choiceId   = "q{$q['id_soal']}_$choice";
                        ?>
                        <div class="choice-option">
                            <input type="radio" id="<?php echo $choiceId ?>"
                                   name="jawaban_user[<?php echo $q['id_soal'] ?>]"
                                   value="<?php echo $choice ?>">
                            <label for="<?php echo $choiceId ?>" class="choice-btn">
                                <?php echo($choiceText) ?>
                            </label>
                        </div>
                    <?php }?>
                </div>

                <div class="nav-buttons">
                    <?php if ($index > 0): ?>
                        <button type="button" class="nav-btn btn-prev">Previous</button>
                    <?php else: ?>
                        <div></div>
                    <?php endif; ?>

                    <?php if ($index < count($soal) - 1): ?>
                        <button type="button" class="nav-btn btn-next">Next</button>
                    <?php else: ?>
                        <button type="submit" class="nav-btn btn-submit">Submit</button>
                    <?php endif; ?>
                </div>
            </div>
        <?php }?>
    </form>
</div>

<script>
    const cards = document.querySelectorAll('.question-card');
    const progressBar = document.querySelector('.progress-bar');
    const currentQuestionSpan = document.getElementById('current-question');
    let current = 0;

    function showCard(index) {
        cards.forEach((c, i) => {
            c.style.display = 'none';
            if (i === index) {
                c.style.display = 'block';
            }
        });

        // Update progress bar
        const progress = ((index + 1) / cards.length) * 100;
        progressBar.style.width = `${progress}%`;
        progressBar.setAttribute('aria-valuenow', progress);

        // Update question counter
        currentQuestionSpan.textContent = index + 1;
    }

    document.querySelectorAll('.btn-next').forEach((btn) => {
        btn.addEventListener('click', () => {
            if (current < cards.length - 1) {
                current++;
                showCard(current);
                window.scrollTo(0, 0);
            }
        });
    });

    document.querySelectorAll('.btn-prev').forEach((btn) => {
        btn.addEventListener('click', () => {
            if (current > 0) {
                current--;
                showCard(current);
                window.scrollTo(0, 0);
            }
        });
    });

    // Inisialisasi awal - hanya soal pertama yang tampil
    showCard(current);
</script>

</body>
</html>

<!--
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mulai Session Quiz</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <h3 class="fw-bold mb-4 text-center"><?php echo $quiz['judul']; ?></h3>

    <form method="post">
        <?php foreach ($soal as $index => $s): ?>
            <div class="card mb-3">
                <div class="card-body">
                    <p class="fw-semibold"><?php echo($index + 1) . ". " . $s['soal']; ?></p>
                    <?php
                        $opsi = [
                            'a' => $s['pilihan_a'] ?? '',
                            'b' => $s['pilihan_b'] ?? '',
                            'c' => $s['pilihan_c'] ?? '',
                            'd' => $s['pilihan_d'] ?? '',
                        ];
                        foreach ($opsi as $key => $text):
                    ?>
    <div class="form-check">
        <input class="form-check-input" type="radio"
               name="jawaban_user[<?php echo $s['id_soal']; ?>]"
               value="<?php echo $key; ?>">
        <label class="form-check-label"><?php echo htmlspecialchars($text); ?></label>
    </div>
<?php endforeach; ?>

                </div>
            </div>
        <?php endforeach; ?>
        <div class="text-center mt-3">
            <button type="submit" class="btn btn-success">Kirim Jawaban</button>
        </div>
    </form>
</div>
</body>
</html> -->
