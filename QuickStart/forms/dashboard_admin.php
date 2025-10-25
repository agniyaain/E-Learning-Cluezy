<?php
    include "koneksi.php";
    include "sidebar.php";

    session_start();

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
    <div class="container-fluid">
        <div class="row">
            <!-- Include Sidebar -->

            <!-- Main Content -->
            <div class="col-md-9 col-lg-10 ms-sm-auto px-4 py-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Dashboard Admin</h1>
                </div>

                <!-- Content -->
                <div class="alert alert-info">
                    <h4>Selamat datang di dashboard admin!</h4>
                    <p>Halo <strong><?php echo $_SESSION['username'] ?? 'Admin'; ?></strong>, selamat datang di sistem administrasi.</p>
                </div>

                <!-- Cards Stats -->
                <div class="row">
                    <div class="col-md-3 mb-4">
                        <div class="card bg-primary text-white">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h4><?php echo $total_user ?></h4>
                                        <p>Total Users</p>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="bi bi-people fs-1"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="card bg-success text-white">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h4><?php echo $total_note ?></h4>
                                        <p>Total Note</p>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="bi bi-file-text fs-1"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="card bg-warning text-white">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h4><?php echo $total_quiz ?></h4>
                                        <p>Total Quiz</p>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="bi bi-clock fs-1"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>