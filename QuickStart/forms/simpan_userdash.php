<?php
session_start();
include "koneksi.php";

$email = $_POST["email"];
$user  = $_POST["username"];
$role = $_POST['role'];
$pass  = $_POST["pass"];

// Cek email
$cek = mysqli_query($koneksi, "SELECT * FROM user WHERE email='$email'");
if (mysqli_num_rows($cek) > 0) {
    echo '<script>
            alert("Email already registered, please try again");
            window.location.href="tambah_userdash.php";
          </script>';
    exit;
}

// Cek username
$result2 = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$user'");
if (mysqli_num_rows($result2) > 0) {
    echo '<script>
            alert("Username already used, please try again");
            window.location.href="register.php";
          </script>';
    exit;
}

// Insert user baru
$query  = "INSERT INTO user (email, username, role, pass) VALUES ('$email','$user', '$role','$pass')";
$result = mysqli_query($koneksi, $query);

if ($result) {
    $id_user = mysqli_insert_id($koneksi);

    // Set session agar langsung login
    $_SESSION['id_user']  = $id_user;
    $_SESSION['username'] = $user;

    header("Location: user_dash.php");
    exit;
} else {
    echo '<script>
            alert("Add User failed, please try again");
            window.location.href="user_dash.php";
          </script>';
    exit;
}
