<?php
    include "koneksi.php";
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
    <style>
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(180deg, #2c3e50 0%, #3498db 100%);
            transition: all 0.3s;
        }

        .sidebar .nav-link {
            color: #ecf0f1;
            padding: 12px 20px;
            margin: 4px 0;
            border-radius: 8px;
            transition: all 0.3s;
        }

        .sidebar .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: #ffffff;
            transform: translateX(5px);
        }

        .sidebar .nav-link.active {
            background-color: #e74c3c;
            color: #ffffff;
        }

        .sidebar .nav-link i {
            margin-right: 10px;
            font-size: 1.1rem;
         }

        .logo {
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .logo h4 {
            color: white;
            margin: 0;
            font-weight: 600;
        }

        .user-info {
            padding: 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            text-align: center;
        }

        .user-info img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            margin-bottom: 10px;
            border: 3px solid rgba(255, 255, 255, 0.2);
        }

        .user-info h6 {
            color: white;
            margin: 5px 0;
        }

        .user-info small {
            color: #bdc3c7;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Include Sidebar -->
            <?php include "sidebar.php"; ?>

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