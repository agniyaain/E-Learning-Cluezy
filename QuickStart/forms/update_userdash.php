<?php
    include "koneksi.php";

    $id_user = $_POST['id_user'];
    $email = $_POST['email'];
    $username = $_POST['username']; 
    $pass = $_POST['pass']; 

    $query = "update user set email='$email', username='$username', pass = '$pass' where id_user=$id_user ";

    //echo $query;
    $result = mysqli_query($koneksi, $query);
    if($result ){
        echo '<script>
                   
                    alert("Update user sukses!");
                    window.location.href="user_dash.php";
                </script>';
        //header("Location: mahasiswa.php");
    } else {
        echo '<script>
                   
                    alert("Update user gagal");
                     window.location.href="user_dash.php";
                </script>';
        //header("Location: mahasiswa.php");
    }
?>