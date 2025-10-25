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
    <!-- <link href="../assets/css/login.css" rel="stylesheet"> -->
    <!-- Favicons -->
    <link href="../assets/img/cluezy-about.png" rel="icon">
</head>

<body>

    <div class="container signup-container">
        <div class="row signup-box w-100">
            <!-- Form -->
            <div class="col-md-6 signup-form">
                <h2 class="fw-bold mb-4">Tambah User</h2>
                <form action="simpan_userdash.php" method="post">
                    <table>
                        <tr>
                            <td>Email</td>
                            <td class="mb-3 input-group">
                                <span class="input-group-text"><i class="bi bi-person"></i></span>
                            <td> <input type="text" class="form-control" name="email" placeholder="Enter Email"></td>
                            </td>
                        </tr>
                        <tr>
                            <td>Username</td>
                            <td class="mb-3 input-group">
                                <span class="input-group-text"><i class="bi bi-person"></i></span>
                            <td> <input type="text" class="form-control" name="username" placeholder="Enter Username"></td>
                            </td>
                        </tr>

                        <tr>
                            <td>Role</td>
                            <td class="mb-3 input-group">
                                <span class="input-group-text"><i class="bi bi-person"></i></span>
                            <td>

                                <input type="radio" class="form-control" name="role" value="admin">Admin <br>
                                <input type="radio" class="form-control" name="role" value="user">User <br>
                            </td>

                            </td>
                        </tr>
                        <tr>
                            <td>Password</td>
                            <td class="mb-3 input-group">
                                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                            <td><input type="password" class="form-control" name="pass" placeholder="Password"> </td>
                            </td>
                        </tr>

                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" value="SUBMIT" class="submit">
                                <input type="reset" value="RESET" class="batal">
                            </td>
                        </tr>
                    </table>

                </form>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>


</body>

</html>