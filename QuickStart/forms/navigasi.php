<link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
<link rel="stylesheet" href="../assets/css/navbar.css">
<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">

  <div class="container-fluid">
    <img src="../assets/img/cluezy-about.png" alt="" width="70" height="47">
    <h1 class="navbar-brand">Cluezy</h1>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
      data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
      aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link" href="home.php">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
            Features
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item " href="note.php"><i class="bi bi-journals icon"></i>  Note Space</a></li>
            <li><a class="dropdown-item " href="quiz.php"><i class="bi bi-patch-question icon"></i>  Quiz Zone </a></li>
            <li><a class="dropdown-item " href="todolist.php"><i class="bi bi-list-task icon"></i>  To Do List</a></li>
            <li><a class="dropdown-item " href="timer.php"><i class="bi bi-alarm icon"></i>  PomPom</a></li>
          </ul>
        </li>
      </ul>
      <form class="d-flex" action="logout.php">
        <button class="btn btn-danger btn-logout" type="submit" onclick="return confirm('Apakah Anda yakin keluar?')">
          Logout
        </button>
      </form>
    </div>
  </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
