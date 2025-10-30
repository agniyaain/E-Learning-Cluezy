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
                    <!-- Card 1 -->
                    <div class="col">
                        <div class="card h-100 border-0">
                            <div class="cute-card card-body p-0">
                                <img class="card-img-top" src="https://images.unsplash.com/photo-1501504905252-473c47e087f8?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=450&h=300&q=80" alt="History">
                                <div class="p-4 text-center">
                                    <h5 class="card-title">Ilmu Sejarah</h5>
                                    <p class="card-text">Sejarah, kelas 10 semester 1</p>
                                    <div class="text-center mt-3"><a class="btn btn-cute" href="note.php">View more <i class="ms-1 fas fa-arrow-right"></i></a></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 2 -->
                    <div class="col">
                        <div class="card h-100 border-0">
                            <div class="cute-card card-body p-0">
                                <img class="card-img-top" src="https://images.unsplash.com/photo-1635070041078-e363dbe005cb?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=450&h=300&q=80" alt="Mathematics">
                                <div class="p-4 text-center">
                                    <h5 class="card-title">Matematika</h5>
                                    <p class="card-text">Matematika, kelas 10 semester 1</p>
                                    <div class="text-center mt-3"><a class="btn btn-cute" href="note.php">View more <i class="ms-1 fas fa-arrow-right"></i></a></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 3 -->
                    <div class="col">
                        <div class="card h-100 border-0">
                            <div class="cute-card card-body p-0">
                                <img class="card-img-top" src="https://images.unsplash.com/photo-1532094349884-543bc11b234d?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=450&h=300&q=80" alt="Science">
                                <div class="p-4 text-center">
                                    <h5 class="card-title">Ilmu Pengetahuan Alam</h5>
                                    <p class="card-text">IPA, kelas 10 semester 1</p>
                                    <div class="text-center mt-3"><a class="btn btn-cute" href="note.php">View more <i class="ms-1 fas fa-arrow-right"></i></a></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 4 -->
                    <div class="col">
                        <div class="card h-100 border-0">
                            <div class="cute-card card-body p-0">
                                <img class="card-img-top" src="https://images.unsplash.com/photo-1546410531-bb4caa6b424d?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=450&h=300&q=80" alt="Language">
                                <div class="p-4 text-center">
                                    <h5 class="card-title">Bahasa Indonesia</h5>
                                    <p class="card-text">Bahasa, kelas 10 semester 1</p>
                                    <div class="text-center mt-3"><a class="btn btn-cute" href="note.php">View more <i class="ms-1 fas fa-arrow-right"></i></a></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 5 -->
                    <div class="col">
                        <div class="card h-100 border-0">
                            <div class="cute-card card-body p-0">
                                <img class="card-img-top" src="https://images.unsplash.com/photo-1576086213369-97a306d36557?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=450&h=300&q=80" alt="Art">
                                <div class="p-4 text-center">
                                    <h5 class="card-title">Seni Budaya</h5>
                                    <p class="card-text">Seni, kelas 10 semester 1</p>
                                    <div class="text-center mt-3"><a class="btn btn-cute" href="note.php">View more <i class="ms-1 fas fa-arrow-right"></i></a></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 6 -->
                    <div class="col">
                        <div class="card h-100 border-0">
                            <div class="cute-card card-body p-0">
                                <img class="card-img-top" src="https://images.unsplash.com/photo-1461749280684-dccba630e2f6?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=450&h=300&q=80" alt="Programming">
                                <div class="p-4 text-center">
                                    <h5 class="card-title">Pemrograman Dasar</h5>
                                    <p class="card-text">Komputer, kelas 10 semester 2</p>
                                    <div class="text-center mt-3"><a class="btn btn-cute" href="note.php">View more <i class="ms-1 fas fa-arrow-right"></i></a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> -->
</body>
<!-- <?php include "footer.php"; ?> -->

</html>