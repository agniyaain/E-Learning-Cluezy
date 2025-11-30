<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cluezy - E-Learning</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Favicons -->
    <link href="../assets/img/cluezy-about.png" rel="icon">
    <link rel="stylesheet" href="../assets/css/home.css">
</head>

<body>
    <!-- Navigation-->
    <?php include "navigasi.php"; ?>
    <!-- Hero -->
    <section class="hero-section text-center">
        <div class="container px-4 px-lg-5">
            <div class="text-white">
                <h1 class="hero-title">Learn Anytime, Anywhere</h1>
                <p class="hero-subtitle">With Cluezy, flexible, simple, and effective learning starts now. <i class="heart-icon fas fa-heart"></i></p>
            </div>
        </div>
    </section>

    <!-- Gallery Cards -->

    <section class="content-section">
        <div class="container">
            <!-- Choose Features -->
            <section class="content-section  pt-0">
                <div class="container">
                    <h2 class="text-center section-title">Choose Features</h2>
                    <div class="row g-4 row-cols-1 row-cols-md-2 row-cols-lg-4 justify-content-center">

                        <!-- Note Feature -->
                        <div class="col">
                            <div class="card h-100 border-0">
                                <div class="cute-card card-body text-center p-4">
                                    <div class="feature-icon mb-3">
                                        <i class="fas fa-sticky-note fa-3x" style="color: var(--color-light-brown);"></i>
                                    </div>
                                    <h5 class="card-title">Notes</h5>
                                    <p class="card-text">Buat dan kelola catatan belajar Anda dengan mudah dan terorganisir.</p>
                                    <div class="text-center mt-3">
                                        <a class="btn btn-cute" href="note.php">
                                            Open Notes <i class="ms-1 fas fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Quiz Feature -->
                        <div class="col">
                            <div class="card h-100 border-0">
                                <div class="cute-card card-body text-center p-4">
                                    <div class="feature-icon mb-3">
                                        <i class="fas fa-question-circle fa-3x" style="color: var(--color-light-brown);"></i>
                                    </div>
                                    <h5 class="card-title">Quiz</h5>
                                    <p class="card-text">Uji pemahaman Anda dengan berbagai kuis interaktif dan menarik.</p>
                                    <div class="text-center mt-3">
                                        <a class="btn btn-cute" href="quiz.php">
                                            Take Quiz <i class="ms-1 fas fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Todo List Feature -->
                        <div class="col">
                            <div class="card h-100 border-0">
                                <div class="cute-card card-body text-center p-4">
                                    <div class="feature-icon mb-3">
                                        <i class="fas fa-tasks fa-3x" style="color: var(--color-light-brown);"></i>
                                    </div>
                                    <h5 class="card-title">To-Do List</h5>
                                    <p class="card-text">Atur jadwal belajar dan tugas-tugas Anda dengan todo list yang praktis.</p>
                                    <div class="text-center mt-3">
                                        <a class="btn btn-cute" href="todolist.php">
                                            Manage Tasks <i class="ms-1 fas fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Timer Feature -->
                        <div class="col">
                            <div class="card h-100 border-0">
                                <div class="cute-card card-body text-center p-4">
                                    <div class="feature-icon mb-3">
                                        <i class="fas fa-clock fa-3x" style="color: var(--color-light-brown);"></i>
                                    </div>
                                    <h5 class="card-title">Study Timer</h5>
                                    <p class="card-text">Gunakan timer untuk mengatur sesi belajar dengan metode Pomodoro.</p>
                                    <div class="text-center mt-3">
                                        <a class="btn btn-cute" href="timer.php">
                                            Start Timer <i class="ms-1 fas fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>

            <h2 class="text-center section-title">Preview Content</h2>
            <div class="position-relative">
                <i class="decorative-element deco-1 fas fa-book-open"></i>
                <i class="decorative-element deco-2 fas fa-graduation-cap"></i>

                <div class="row g-4 row-cols-1 row-cols-md-2 row-cols-lg-3 justify-content-center">
                    <?php
                    include "koneksi.php";
                    $query  = "SELECT * FROM catatan LIMIT 6";
                    $result = mysqli_query($koneksi, $query);

                    if ($result && mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            // Ambil file dari kolom 'isi' (pisahkan jika lebih dari 1)
                            $files = !empty($row['isi']) ? array_map('trim', explode(",", $row['isi'])) : [];
                            $preview = '';

                            if (!empty($files)) {
                                $firstFile = $files[0];
                                $ext = strtolower(pathinfo($firstFile, PATHINFO_EXTENSION));
                                if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif'])) {
                                    $preview = "<img src='../assets/uploads/" . htmlspecialchars($firstFile) . "' alt='" . htmlspecialchars($row['judul']) . "' class='card-img-top'>";
                                } else {
                                    $preview = "<div class='placeholder'><i class='fas fa-file fa-3x'></i></div>";
                                }
                            } else {
                                $preview = "<div class='placeholder'><i class='fas fa-sticky-note fa-3x'></i></div>";
                            }
                    ?>
                            <div class="col">
                                <div class="card h-100 border-0">
                                    <div class="cute-card card-body p-0">
                                        <?= $preview ?>
                                        <div class="p-4 text-center">
                                            <h5 class="card-title"><?= htmlspecialchars($row['judul']) ?></h5>
                                            <p class="card-text"><?= htmlspecialchars($row['deskripsi']) ?></p>
                                            <div class="text-center mt-3">
                                                <a class="btn btn-cute" href="detail_note.php?id_note=<?= $row['id_note'] ?>">
                                                    View more <i class="ms-1 fas fa-arrow-right"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    } else {
                        echo '<p class="text-center">Belum ada catatan yang tersedia.</p>';
                    }
                    ?>
                </div>
            </div>


        </div>
    </section>

    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> -->
</body>
<!-- <?php include "footer.php"; ?> -->

</html>