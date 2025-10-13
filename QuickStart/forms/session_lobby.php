<?php
    session_start();
    include "koneksi.php";

    $id_session = $_GET['id_session'] ?? 0;
    $session    = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM quiz_session WHERE id_session='$id_session'"));

    if (! $session) {
        die("Session tidak ditemukan");
    }

    $quiz = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM quiz WHERE id_quiz='{$session['id_quiz']}'"));
?>
<!doctype html>
<html lang="en">
<head>
    <title>Session Lobby</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="../assets/css/det_quiz.css">
</head>
<body class="bg-light">
<div class="container text-center py-5">
    <h3 class="fw-bold"><?php echo $quiz['judul'] ?></h3>
    <h1 class="display-3 fw-bold my-4"><?php echo $session['kode_session'] ?></h1>
    <p class="text-muted">Bagikan kode ini ke orang lain untuk join quiz</p>

    <a href="mulai_session.php?id_session=<?php echo $id_session ?>" class="btn btn-success mt-3">Mulai Quiz 🚀</a>
</div>
</body>
</html>

