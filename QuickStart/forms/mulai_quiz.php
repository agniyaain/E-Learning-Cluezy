<?php
    session_start();
    include "koneksi.php";

    $id_quiz = $_GET['id_quiz'] ?? 0;
    $query   = "SELECT * FROM quiz WHERE id_quiz = '$id_quiz'";
    $result  = mysqli_query($koneksi, $query);
    $quiz    = mysqli_fetch_assoc($result);

    if (! $quiz) {
        die("Quiz not found");
    }

    $query2  = "SELECT * FROM soal WHERE id_quiz= '$id_quiz'";
    $result2 = mysqli_query($koneksi, $query2);
    $soal    = mysqli_fetch_all($result2, MYSQLI_ASSOC);

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
    <title>Quiz:                                                                                                                                                                 <?php echo($quiz['judul']) ?></title>
    <link rel="stylesheet" href="../assets/css/mulai_quiz.css">
</head>
<body>
<div class="quiz-container">
    <div class="quiz-header">
        <div class="quiz-title"><?php echo($quiz['judul']) ?></div>
    </div>

    <div class="progress-container">
        <div class="question-counter">Question <span id="current-question">1</span> of                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             <?php echo count($soal) ?></div>
        <div class="progress">
            <div class="progress-bar" role="progressbar" style="width:                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             <?php echo(1 / count($soal)) * 100 ?>%;"
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
setInterval(() => {
    fetch("cek_status.php?id_session=<?php echo $id_session?>")
        .then(res => res.json())
        .then(data => {
            if (data.status === 'running') {
                window.location.href = "mulai_quiz.php?id_session=<?php echo $id_session?>";
            }
        });
}, 2000);
</script>


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