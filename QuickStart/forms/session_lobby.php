<?php
    session_start();
    include "koneksi.php";

    $id_session = $_GET['id_session'] ?? 0;
    $session    = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM quiz_session WHERE id_session='$id_session'"));

    if (! $session) {
        die("Session tidak ditemukan");
    }

    // Cek user = owner code quiz
    $is_owner = (isset($session['id_user']) && $session['id_user'] == $_SESSION['id_user']);

    $quiz = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM quiz WHERE id_quiz='{$session['id_quiz']}'"));

    // Query untuk mengambil nilai peserta
    $peserta = mysqli_query($koneksi, "
        SELECT u.username, us.nilai
        FROM user_session us
        JOIN user u ON us.id_user = u.id_user
        WHERE us.id_session='$id_session'
    ");

    $session_status = $session['status'];
?>
<!doctype html>
<html lang="en">

<head>
    <title>Session Lobby</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/css/det_quiz.css">
</head>

<body class="bg-light">
    <div class="container text-center py-5">
        <h3 class="fw-bold"><?php echo $quiz['judul'] ?></h3>
        <h1 class="display-3 fw-bold my-4" id="textToCopy"><?php echo $session['kode_session'] ?></h1>
        <p class="text-muted">Bagikan kode ini ke orang lain untuk join quiz</p>

        <div class="alert alert-info mb-4">
            Status : <strong>
                <?php
                    if ($session_status == 'waiting') {
                        echo 'Menunggu';
                    } elseif ($session_status == 'running') {
                        echo 'Sedang Berlangsung';
                    } else {
                        echo 'Selesai';
                    }
                ?>
            </strong>
        </div>

        <div class="mt-4 text-start mx-auto" style="max-width: 400px;">
            <h5 class="fw-bold mb-2">👥 Peserta yang sudah join:</h5>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $totalPeserta = 0;
                            while ($p = mysqli_fetch_assoc($peserta)):
                                $totalPeserta++;
                            ?>
									                            <tr>
									                                <td><?php echo htmlspecialchars($p['username']) ?></td>
									                                <td>
									                                    <?php
                                                                                if ($p['nilai'] !== null) {
                                                                                    echo $p['nilai'];
                                                                                } else {
                                                                                    echo '<span class="text-muted">-</span>';
                                                                                }
                                                                            ?>
									                                </td>
									                            </tr>
									                        <?php endwhile; ?>

                        <?php if ($totalPeserta == 0): ?>
                        <tr>
                            <td colspan="2" class="text-center text-muted">
                                Belum ada peserta yang join
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <?php if ($is_owner): ?>
    <?php if ($session_status == 'waiting'): ?>
        <a href="mulai_session.php?id_session=<?php echo $id_session ?>" class="btn btn-success btn-lg mt-3">
            Mulai Quiz 🚀
        </a>
    <?php elseif ($session_status == 'running'): ?>
        <button class="btn btn-warning btn-lg mt-3" disabled>
            Quiz Sedang Berlangsung ⏳
        </button>
        <a href="selesai_session.php?id_session=<?php echo $id_session ?>" class="btn btn-danger btn-lg mt-3">
            Akhiri Quiz 🏁
        </a>

        <!-- Tombol Export Excel -->
        <a href="export_excel.php?id_session=<?php echo $id_session ?>" class="btn btn-info btn-lg mt-3">
            📊 Export Excel
        </a>

    <?php else: ?>
        <div class="alert alert-success mt-3">
            <h5>Quiz Telah Selesai</h5>
            <p>Semua peserta sudah menyelesaikan quiz</p>
        </div>
        <?php endif; ?>

        <?php else: ?>
            <!-- Untuk Peserta -->
            <?php if ($session_status == 'waiting'): ?>
                <div class="alert alert-warning mt-3">
                    <h5>Menunggu Host Memulai Quiz...</h5>
                    <p>Silakan tunggu hingga pemilik quiz menekan tombol "Mulai Quiz"</p>
                </div>
            <?php elseif ($session_status == 'running'): ?>
                <a href="session_quiz.php?id_session=<?php echo $id_session ?>" class="btn btn-primary btn-lg mt-3">
                    Kerjakan Quiz Sekarang 🎯
                </a>
            <?php else: ?>
                <div class="alert alert-secondary mt-3">
                    <h5>Quiz Telah Selesai</h5>
                    <p>Terima kasih telah berpartisipasi!</p>
                </div>
                <a href="quiz.php" class="btn btn-primary btn-lg mt-3">
                    Kembali ke Menu Quiz
                </a>
            <?php endif; ?>


        <!-- Tombol Export Excel untuk session selesai
        <a href="export_excel.php?id_session=<?php echo $id_session ?>" class="btn btn-success btn-lg mt-3">
            📊 Download Hasil Excel
        </a> -->

    <?php endif; ?>

    </div>

    <script>
        function copyToClipboard() {
            const textToCopy = document.getElementById('textToCopy').innerText;

            navigator.clipboard.writeText(textToCopy)
                .then(() => {
                    alert('Kode berhasil disalin: ' + textToCopy);
                })
                .catch(err => {
                    console.error('Gagal menyalin teks: ', err);
                });
        }

        // Auto refresh untuk peserta yang menunggu
        <?php if ((! $is_owner && $session_status == 'waiting') || $session_status == 'running'): ?>
        setInterval(() => {
            location.reload();
        }, 3000);
        <?php endif; ?>
    </script>
</body>
</html>