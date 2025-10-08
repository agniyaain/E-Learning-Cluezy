<?php
    session_start();
    include "koneksi.php";

    if (! isset($_SESSION['id_user'])) {
        header("Location: login.php");
        exit;
    }

    $id_quiz = $_GET['id_quiz'] ?? 0;
    $query   = "SELECT * FROM quiz WHERE id_quiz = '$id_quiz'";
    $result  = mysqli_query($koneksi, $query);
    $quiz    = mysqli_fetch_assoc($result);
    if (! $quiz) {
        die("Quiz not found");
    }

    // DEBUG: Cek data yang didapat dari database
    error_log("Quiz Data - ID: " . $quiz['id_quiz'] . ", Judul: " . $quiz['judul'] . ", Jumlah Soal: " . $quiz['jumlah_soal']);

    // Hitung jumlah soal yang sebenarnya dari tabel soal
    $query_soal_count = "SELECT COUNT(*) as total_soal FROM soal WHERE id_quiz = '$id_quiz'";
    $result_count     = mysqli_query($koneksi, $query_soal_count);
    $soal_count       = mysqli_fetch_assoc($result_count)['total_soal'];

    error_log("Actual soal count in database: " . $soal_count);
?>

<!doctype html>
<html lang="en">
<head>
    <title><?php echo($quiz['judul']) ?> - Start</title>
    <link rel="stylesheet" href="../assets/css/det_quiz.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="../assets/img/cluezy-about.png" rel="icon">
</head>
<body class="bg-light">
<div class="container py-5">
    <div class="quiz-card">
        <div class="row g-1 align-items-center">
            <h3 class="fw-bold text-center"><?php echo($quiz['judul']) ?></h3>
            <p class="mb-1"><?php echo($quiz['deskripsi']) ?></p>

            <small class="text-muted">Total Questions:                                                                                                                                                                                                                                                                               <?php echo $soal_count ?></small>
        </div>

        <div class="text-center mt-4">
            <a href="mulai_quiz.php?id_quiz=<?php echo $quiz['id_quiz'] ?>" class="btn btn-success">Start</a>
        </div>

        <?php if ($quiz['id_user'] == $_SESSION['id_user']) {?>
            <div class="text-center mt-2">
                <a href="edit_quiz.php?id_quiz=<?php echo $quiz['id_quiz']; ?>" class="btn btn-warning btn-sm">Edit</a>
                <a href="delete_quiz.php?id_quiz=<?php echo $quiz['id_quiz']; ?>"
                   onclick="return confirm('Yakin hapus quiz ini?')"
                   class="btn btn-danger btn-sm">Delete</a>
            </div>
        <?php }?>
    </div>
</div>
</body>
</html>