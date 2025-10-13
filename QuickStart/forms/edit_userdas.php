<?php 
    session_start();
    // if(!isset($_SESSION['username'])){
    //     header("Location: index.php");
    // }
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit User</title>
        <!-- <link rel="stylesheet" href="style.css"> -->
    </head>
    <body> 
        <div class="container" >
            <h1>Edit User</h1>
            <hr>
            <?php
                $id_user = $_GET['id_user'];
                include("koneksi.php");

                $query = "select * from user where id_user=$id_user";
                $result = mysqli_query($koneksi, $query);
                $data = mysqli_fetch_assoc($result);
            
            ?>
            <form action="update_userdash.php" method="post">
                <table>
                
                    <tr>
                <td width="150px">Email</td>
                <td>
                    <input type="hidden" name="id_user" value="<?php echo $data['id_user'];?>">
                    <input type="text" name="email" value="<?php echo $data['email'];?>">
                </td>
            </tr>
            <tr>
                <td>Username</td>
                <td><input type="text" name="username" value="<?php echo $data['username'];?>"></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input type="text" name="pass" value="<?php echo $data['pass'];?>"></td>
            </tr>

                    <td></td>
                    <td>
                        <input type="submit" value = "SUBMIT" class = "submit">
                        <a href="user_dash.php" value = "RESET" class = "batal"> BATAL </a>
                    </td>
                </tr>
                </table>
            </form>

        </div>
    </body>
    </html>