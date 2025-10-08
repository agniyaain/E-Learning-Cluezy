<?php
    session_start();
?>
<!DOCTYPE html>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <link href="../assets/css/login.css" rel="stylesheet">
    <!-- Favicons -->
   <link href="../assets/img/cluezy-about.png" rel="icon">
</head>
<body>

<div class="container signup-container">
  <div class="row signup-box w-100">
     <!-- Gambar -->
    <div class="col-md-6 signup-img d-none d-md-flex">
      <img src="../assets/img/cluezy.png" alt="illustration">
    </div>
    <!-- Form -->
    <div class="col-md-6 signup-form">
      <h2 class="fw-bold mb-4">Register</h2>
      <form action="cek_register.php" method="post">
          <h5>Email</h5>
        <div class="mb-3 input-group">
          <span class="input-group-text"><i class="bi bi-person"></i></span>
          <input type="text" class="form-control" name="email" placeholder="Enter Email">
        </div>
          <h5>Username</h5>
        <div class="mb-3 input-group">
          <span class="input-group-text"><i class="bi bi-person"></i></span>
          <input type="text" class="form-control" name="username" placeholder="Enter Username">
        </div>
        <h5>Password</h5>
        <div class="mb-3 input-group">
          <span class="input-group-text"><i class="bi bi-lock"></i></span>
          <input type="password" class="form-control" name="pass" placeholder="Password">
        </div>
 <div>
            <p><h6>Already have account?<a href="login.php"> Login now!</a> </h6></p>
        </div>



        <button type="submit" class="btn btn-primary w-100">Register</button>


      </form>
    </div>

  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>


</body>
</html>
