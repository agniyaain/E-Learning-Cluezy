<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Cluezy</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="assets/img/cluezy-about.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="index.html" class="logo d-flex align-items-center me-auto">
        <img src="assets/img/cluezy.png" alt="">
        <h1 class="sitename">Cluezy</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="index.html#hero" class="active">Home</a></li>
          <li><a href="index.html#about">About</a></li>
          <li><a href="index.html#features">Features</a></li>
          <li><a href="index.html#tips&trick">Tips Trick</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <a class="btn-getstarted" href="forms/login.php">Get Started</a>

    </div>
  </header>

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section">
      <div class="hero-bg">
        <img src="assets/img/hero-bg-light.webp" alt="">
      </div>
      <div class="container text-center">
        <div class="d-flex flex-column justify-content-center align-items-center">
          <h1 data-aos="fade-up">Welcome to <span>Cluezy</span></h1>
          <p data-aos="fade-up" data-aos-delay="100">One small step, one big lesson. Let’s get started!<br></p>
          <div class="d-flex" data-aos="fade-up" data-aos-delay="200">
            <a href="forms/login.php" class="btn-get-started">Get Started</a>
          </div>
          <img src="assets/img/cluezy-home.png" class="img-fluid hero-img" alt="" data-aos="zoom-out" data-aos-delay="300">
        </div>
      </div>

    </section><!-- /Hero Section -->

    <!-- About Section -->
    <section id="about" class="about section">

      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="100">
            <p class="who-we-are">Apa itu Cluezy?</p>
            <h3>Cluezy - Web E-Learning</h3>
            <p class="fst-italic">
              Cluezy adalah platform e-learning berbasis web yang dibuat dengan tampilan lucu, ringan, dan mudah digunakan. Platform ini cocok untuk pelajar yang ingin belajar secara:
            </p>
            <ul>
              <li><i class="bi bi-check-circle"></i> <span>Mandiri</span></li>
              <li><i class="bi bi-check-circle"></i> <span>Fleksibel</span></li>
              <li><i class="bi bi-check-circle"></i> <span>Menyenangkan</span></li>
            </ul>
          </div>

          <div class="col-lg-6 about-images" data-aos="fade-up" data-aos-delay="200">
            <div class="row gy-4">
              <div class="col-lg-6">
                <img src="assets/img/cluezy-about.png" class="img-fluid" alt="">
              </div>
            </div>
          </div>
        </div>
      </div>
    </section><!-- /About Section -->

    <!-- Fitur Section -->
    <section id="features" class="services section light-background">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Features Cluezy</h2>
        <p>Cluezy has 4 amazing features designed to support your learning journey!</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row g-5">

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
            <div class="service-item item-cyan position-relative">
              <i class="bi bi-journals icon"></i>
              <div>
                <h3>Notes</h3>
                <p>Upload and read notes anytime! Make studying easier with quick access to all your learning materials.</p>
                <a href="login.php" class="read-more stretched-link">Check It Out<i class="bi bi-arrow-right"></i></a>
              </div>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
            <div class="service-item item-orange position-relative">
              <i class="bi bi-patch-question icon"></i>
              <div>
                <h3>Quiz</h3>
                <p>Test your knowledge with fun quizzes! Turn learning into an engaging and interactive experience.</p>
                <a href="login.php" class="read-more stretched-link">Try It <i class="bi bi-arrow-right"></i></a>
              </div>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
            <div class="service-item item-teal position-relative">
              <i class="bi bi-list-task icon"></i>
              <div>
                <h3>To Do List</h3>
                <p>Stay organized and never miss a task! Manage your study schedule easily with a simple and effective to-do list.</p>
                <a href="login.php" class="read-more stretched-link">Plan Now<i class="bi bi-arrow-right"></i></a>
              </div>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="400">
            <div class="service-item item-red position-relative">
              <i class="bi bi-alarm icon"></i>
              <div>
                <h3>Timer</h3>
                <p>Boost your focus with smart study sessions! Use the timer to stay productive and manage your learning time better.</p>
                <a href="login.php" class="read-more stretched-link">Start Now<i class="bi bi-arrow-right"></i></a>
              </div>
            </div>
          </div><!-- End Service Item -->
        </div>
      </div>
</section><!-- /Fitur Section -->

    <!-- Tips n  Trick -->
        <section id="tips&trick" class="featured-services section light-background">
          <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Tips & Tricks</h2>
        <p>Learn effective study methods and helpful tricks to improve your learning process.</p>
      </div><!-- End Section Title -->
      <div class="container">

        <div class="row gy-4">

          <div class="col-xl-4 col-lg-6" data-aos="fade-up" data-aos-delay="50">
            <div class="service-item d-flex">
              <div class="icon flex-shrink-0"><i class="bi bi-hand-index"></i></div>
              <div>
                <h4 class="title"><a href="#" class="stretched-link">Use Cluezy</a></h4>
                <p class="description">Make the most of Cluezy’s features to organize your learning and boost productivity.</p>
              </div>
            </div>
          </div>

          <div class="col-xl-4 col-lg-6" data-aos="fade-up" data-aos-delay="100">
            <div class="service-item d-flex">
              <div class="icon flex-shrink-0"><i class="bi bi-stopwatch"></i></div>
              <div>
                <h4 class="title"><a href="#" class="stretched-link">25-5 Method</a></h4>
                <p class="description">Study for 25 minutes and take a 5-minute break. Stay focused without feeling overwhelmed.</p>
              </div>
            </div>
          </div>
          <!-- End Service Item -->

          <div class="col-xl-4 col-lg-6" data-aos="fade-up" data-aos-delay="200">
            <div class="service-item d-flex">
              <div class="icon flex-shrink-0"><i class="bi bi-card-checklist"></i></div>
              <div>
                <h4 class="title"><a href="#" class="stretched-link">Check List</a></h4>
                <p class="description">Write down your tasks and tick them off one by one to stay on track.</p>
              </div>
            </div>
          </div><!-- End Service Item -->

          <div class="col-xl-4 col-lg-6" data-aos="fade-up" data-aos-delay="300">
            <div class="service-item d-flex">
              <div class="icon flex-shrink-0"><i class="bi bi-bar-chart"></i></div>
              <div>
                <h4 class="title"><a href="#" class="stretched-link">Start Small</a></h4>
                <p class="description">Begin with simple goals, then gradually challenge yourself with bigger tasks.</p>
              </div>
            </div>
          </div><!-- End Service Item -->
          <div class="col-xl-4 col-lg-6" data-aos="fade-up" data-aos-delay="300">
            <div class="service-item d-flex">
              <div class="icon flex-shrink-0"><i class="bi bi-music-note-beamed"></i></div>
              <div>
                <h4 class="title"><a href="#" class="stretched-link">Listen to Music</a></h4>
                <p class="description">Play soft background music to stay relaxed and improve concentration.</p>
              </div>
            </div>
          </div><!-- End Service Item -->
          <div class="col-xl-4 col-lg-6" data-aos="fade-up" data-aos-delay="300">
            <div class="service-item d-flex">
              <div class="icon flex-shrink-0"><i class="bi bi-bookmark-check"></i></div>
              <div>
                <h4 class="title"><a href="#" class="stretched-link">Set Target</a></h4>
                <p class="description">Define clear learning goals and measure your progress step by step.</p>
              </div>
            </div>
          </div><!-- End Service Item -->

        </div>

      </div>

    </section><!-- End Tab Nav -->

          </div>



  <footer id="footer" class="footer position-relative light-background">

    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-4 col-md-6 footer-about">
          <a href="index.html" class="logo d-flex align-items-center">
            <span class="sitename">Cluezy</span>
          </a>
          <div class="footer-contact pt-3">
            <p>SMK PGRI 03 Malang</p>
            <p>Tlogomas, Malang Jawa Timur</p>
            <p class="mt-3"><strong>Phone:</strong> <span>+62 89603787643</span></p>
            <p><strong>Email:</strong> <span>agniyaakun@gmail.com</span></p>
          </div>
          <div class="social-links d-flex mt-4">
            <a href="https://x.com/studiestune"><i class="bi bi-twitter-x"></i></a>
            <a href="https://github.com/agniyaain"><i class="bi bi-github"></i></a>
            <a href="https://www.instagram.com/isn_tniya"><i class="bi bi-instagram"></i></a>
            <a href=""><i class="bi bi-linkedin"></i></a>
          </div>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Useful Links</h4>
          <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Features</a></li>
            <li><a href="#">Tips & Trick</a></li>
          </ul>
        </div>

        <div class="col-lg-6 footer-images">
          <div class="row gy-4">
            <div class="col-lg-6 col-md-6">
              <img src="assets/img/cluezy-about.png" class="img-fluid" alt="">
            </div>
          </div>
        </div>

      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">Cluezy</strong><span>All Rights Reserved</span></p>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you've purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
      </div>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>
