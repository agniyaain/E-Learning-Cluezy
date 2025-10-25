<?php
session_start();
include "koneksi.php";
include "sidebar.php";

$queryUser  = "SELECT COUNT(*) as total_user FROM user";
$resultUser = mysqli_query($koneksi, $queryUser);
$dataUser   = mysqli_fetch_assoc($resultUser);
$total_user = $dataUser['total_user'];

$queryNote  = "SELECT COUNT(*) as total_note FROM catatan";
$resultNote = mysqli_query($koneksi, $queryNote);
$dataNote   = mysqli_fetch_assoc($resultNote);
$total_note = $dataNote['total_note'];

$queryQuiz  = "SELECT COUNT(*) as total_quiz FROM quiz";
$resultQuiz = mysqli_query($koneksi, $queryQuiz);
$dataQuiz   = mysqli_fetch_assoc($resultQuiz);
$total_quiz = $dataQuiz['total_quiz'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/css/notedash.css">
</head>

<body>
    <div class="dashboard-container">
        <div class="dashboard-row">
            <!-- Sidebar sudah include di sidebar.php -->

            <!-- Main Content -->
            <main class="dashboard-main">

                <!-- Dashboard Content -->
                <div class="dashboard-content">
                    <div class="container">
                        <!-- Welcome Alert -->
                        <div class="welcome-alert">
                            <h4><i class="bi bi-info-circle"></i> Selamat datang di dashboard admin!</h4>
                            <p>Anda dapat mengelola users, notes, dan quiz dari sini. Semua fitur tersedia di sidebar menu.</p>
                        </div>

                        <!-- Stats Cards -->
                        <div class="stats-grid">
                            <div class="row">
                                <div class="col-xl-4 col-md-4 col-sm-6 mb-4">
                                    <div class="stat-card user-card">
                                        <div class="card-body">
                                            <div class="stat-content">
                                                <h2><?php echo $total_user ?></h2>
                                                <p>Total Users</p>
                                            </div>
                                            <div class="stat-icon">
                                                <i class="bi bi-people-fill"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-4 col-sm-6 mb-4">
                                    <div class="stat-card note-card">
                                        <div class="card-body">
                                            <div class="stat-content">
                                                <h2><?php echo $total_note ?></h2>
                                                <p>Total Notes</p>
                                            </div>
                                            <div class="stat-icon">
                                                <i class="bi bi-journal-text"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-4 col-sm-6 mb-4">
                                    <div class="stat-card quiz-card">
                                        <div class="card-body">
                                            <div class="stat-content">
                                                <h2><?php echo $total_quiz ?></h2>
                                                <p>Total Quiz</p>
                                            </div>
                                            <div class="stat-icon">
                                                <i class="bi bi-question-square-fill"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Quick Actions -->
                        <div class="quick-actions">
                            <h3><i class="bi bi-lightning-charge"></i> Quick Actions</h3>
                            <div class="action-buttons-grid">
                                <a href="user_dash.php" class="action-btn">
                                    <i class="bi bi-people-fill"></i>
                                    <span>Kelola Users</span>
                                </a>
                                <a href="note_dash.php" class="action-btn">
                                    <i class="bi bi-journal-text"></i>
                                    <span>Kelola Notes</span>
                                </a>
                                <a href="quiz_dash.php" class="action-btn">
                                    <i class="bi bi-question-square"></i>
                                    <span>Kelola Quiz</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>