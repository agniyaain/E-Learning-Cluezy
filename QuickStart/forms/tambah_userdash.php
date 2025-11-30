<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah User - Admin</title>
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
                <h2 class="fw-bold mb-4">Tambah User Baru</h2>
                <form action="simpan_userdash.php" method="post">
                    <!-- Email Field -->
                    <div class="form-group mb-3">
                        <label class="form-label">Email</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                            <input type="email" class="form-control" name="email" placeholder="Enter Email" required>
                        </div>
                    </div>

                    <!-- Username Field -->
                    <div class="form-group mb-3">
                        <label class="form-label">Username</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-person"></i></span>
                            <input type="text" class="form-control" name="username" placeholder="Enter Username" required>
                        </div>
                    </div>

                    <!-- Role Field -->
                    <div class="form-group mb-3">
                        <label class="form-label">Role</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-shield-check"></i></span>
                            <div class="form-control role-selection">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="role" id="roleAdmin" value="admin" required>
                                    <label class="form-check-label" for="roleAdmin">Admin</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="role" id="roleUser" value="user">
                                    <label class="form-check-label" for="roleUser">User</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Password Field -->
                    <div class="form-group mb-4">
                        <label class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-lock"></i></span>
                            <input type="password" class="form-control" name="pass" placeholder="Password" required>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="form-group button-group">
                        <button type="submit" class="btn submit">SUBMIT</button>
                        <a href="user_dash.php" class="btn batal">BATAL</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>