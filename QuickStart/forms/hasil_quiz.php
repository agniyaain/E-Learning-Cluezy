<?php
    session_start();
    include "koneksi.php";

    // if (! isset($_SESSION['id_quiz'], $_SESSION['jawaban_user'])) {
    //     header('Location: quiz.php');
    //     exit;
    // }

    $id_quiz = $_SESSION['id_quiz'];
    $answers = $_SESSION['jawaban_user'];

    $id_session = $_SESSION['id_session'] ?? ($_GET['id_session'] ?? null);

    if (! $id_session) {
        die("Session quiz tidak ditemukan. Silakan ulangi quiz.");
    }

    // Ambil quiz dan soal
    $query  = "SELECT * FROM quiz WHERE id_quiz = '$id_quiz'";
    $result = mysqli_query($koneksi, $query);
    $quiz   = mysqli_fetch_assoc($result);

    $query2    = "SELECT * FROM soal WHERE id_quiz = '$id_quiz'";
    $result2   = mysqli_query($koneksi, $query2);
    $questions = mysqli_fetch_all($result2, MYSQLI_ASSOC);

    // Hitung skor & prepare tampilan per soal
    $total   = count($questions);
    $correct = 0;

    $answersDetail = [];

    foreach ($questions as $q) {
        $qId       = $q['id_soal'];
        $userAns   = $answers[$qId] ?? null;
        $isCorrect = ($userAns == $q['jawaban_benar']);
        if ($isCorrect) {
            $correct++;
        }

        $answersDetail[] = [
            'soal'          => $q['soal'],
            'jawaban_user'  => $userAns,
            'jawaban_benar' => $q['jawaban_benar'],
            'choices'       => [
                'a' => $q['pilihan_a'],
                'b' => $q['pilihan_b'],
                'c' => $q['pilihan_c'],
                'd' => $q['pilihan_d'],
            ],
            'is_correct'    => $isCorrect,
        ];
    }

    if ($total > 0) {
        $scorePercent = round(($correct / $total) * 100);
    } else {
        $scorePercent = 0;
    }

    $id_user    = $_SESSION['id_user'];
    $id_session = $_SESSION['id_session'];
    $nilai      = $scorePercent;

mysqli_query($koneksi, "UPDATE user_session SET nilai = '$nilai' WHERE id_session = '$id_session' AND id_user= '$id_user'"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Result</title>
    <link rel="stylesheet" href="../assets/css/hasil_quiz.css">
</head>
<body>
    <div class="container">
        <div class="result-header">
            <div class="result-title">Result:                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               <?php echo htmlspecialchars($quiz['judul']) ?></div>
            <div class="result-score">Score:                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         <?php echo $correct ?> /<?php echo $total ?> (<?php echo $scorePercent ?>%)</div>

            <div class="filter-buttons">
                <button type="button" class="btn btn-primary filter-btn" onclick="filterAnswers('all')">Semua</button>
                <button type="button" class="btn btn-success filter-btn" onclick="filterAnswers('correct')">Benar</button>
                <button type="button" class="btn btn-danger filter-btn" onclick="filterAnswers('wrong')">Salah</button>
            </div>
        </div>

        <div id="answersContainer">
            <?php foreach ($answersDetail as $i => $a): ?>
                <div class="question-card" data-correct="<?php echo $a['is_correct'] ? 'true' : 'false' ?>">
                    <div class="question-number">Question                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       <?php echo $i + 1 ?></div>
                    <div class="question-text"><?php echo($a['soal']) ?></div>

                    <div class="answer-options">
                        <?php foreach ($a['choices'] as $key => $val):
                                $isUserAnswer    = ($key == $a['jawaban_user']);
                                $isCorrectAnswer = ($key == $a['jawaban_benar']);

                                $optionClass = "answer-option";
                                if ($isCorrectAnswer) {
                                    $optionClass .= " correct-answer";
                                } elseif ($isUserAnswer && ! $isCorrectAnswer) {
                                $optionClass .= " wrong-answer";
                            }
                        ?>
                            <div class="<?php echo $optionClass ?>">
                                <strong><?php echo $key ?>.</strong><?php echo($val) ?>
                                <?php if ($isUserAnswer): ?>
                                    <span class="user-answer-label">(Your answer)</span>
                                <?php endif; ?>
                                <?php if ($isCorrectAnswer): ?>
                                    <span class="correct-answer-label">(Correct answer)</span>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <a href="quiz.php" class="back-button">Back</a>
    </div>

    <script>
        function filterAnswers(type) {
            document.querySelectorAll('.filter-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            event.target.classList.add('active');

            const questions = document.querySelectorAll('.question-card');
            questions.forEach(question => {
                if (type === 'all') {
                    question.style.display = 'block';
                } else if (type === 'correct') {
                    question.style.display = question.dataset.correct === 'true' ? 'block' : 'none';
                } else if (type === 'wrong') {
                    question.style.display = question.dataset.correct === 'false' ? 'block' : 'none';
                }
            });
        }
    </script>
</body>
</html>
