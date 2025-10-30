<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="../assets/css/user_dash.css" rel="stylesheet">
    <link href="../assets/img/cluezy-about.png" rel="icon">
</head>

<body>

    <div class="container signup-container">
        <div class="row signup-box w-100">
            <!-- Form Section -->
            <div class="col-12 signup-form">
                <h2 class="fw-bold mb-4">Edit User</h2>
                <?php
                $id_user = $_GET['id_user'];
                include "koneksi.php";

                $query  = "select * from user where id_user=$id_user";
                $result = mysqli_query($koneksi, $query);
                $data   = mysqli_fetch_assoc($result);
                ?>
                <form action="update_userdash.php" method="post">
                    <input type="hidden" name="id_user" value="<?php echo $data['id_user']; ?>">

                    <!-- Email Field -->
                    <div class="form-group mb-3">
                        <label class="form-label">Email</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                            <input type="email" class="form-control" name="email" value="<?php echo $data['email']; ?>" required>
                        </div>
                    </div>

                    <!-- Username Field -->
                    <div class="form-group mb-3">
                        <label class="form-label">Username</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-person"></i></span>
                            <input type="text" class="form-control" name="username" value="<?php echo $data['username']; ?>" required>
                        </div>
                    </div>

                    <!-- Password Field -->
                    <div class="form-group mb-4">
                        <label class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-lock"></i></span>
                            <input type="text" class="form-control" name="pass" value="<?php echo $data['pass']; ?>" required>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="form-group button-group">
                        <button type="submit" class="btn submit">UPDATE</button>
                        <a href="user_dash.php" class="btn batal">BATAL</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>