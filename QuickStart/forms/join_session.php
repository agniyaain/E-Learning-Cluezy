<?php
    session_start();
    include "koneksi.php";

    $kode  = '';
    $error = '';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $kode    = $_POST['kode'];
        $res     = mysqli_query($koneksi, "SELECT * FROM quiz_session WHERE kode_session='$kode' AND status='waiting'");
        $session = mysqli_fetch_assoc($res);

        if ($session) {

            if ($session['status'] != 'waiting') {
                $error = "Session sudah dimulai atau selesai";
            }
            $id_user = $_SESSION['id_user'];

            $check_join = mysqli_query($koneksi, "SELECT * FROM user_session
        WHERE id_session='{$session['id_session']}' AND id_user = '$id_user'");

            if (mysqli_num_rows($check_join) == 0) {
                mysqli_query($koneksi, "INSERT INTO user_session (id_session, id_user, nilai) VALUES ('{$session['id_session']}', '$id_user', NULL)");
            }

            header("Location: session_quiz.php?id_session=" . $session['id_session']);
            exit;
        } else {
            if ($session) {
                header("Location: session_quiz.php?id_session=" . $session['id_session']);
                exit;
            } else {
                $error = "Kode salah atau sesi sudah dimulai.";
            }
        }
    }
?>
<!doctype html>
<html lang="en">
<head>
    <title>Join Quiz Session</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
<link rel="stylesheet" href="../assets/css/lob_quiz.css">

</head>
<body class="bg-light">
<div class="container text-center py-5">
    <h2 class="fw-bold mb-4">Join Quiz</h2>
    <form method="post" style="max-width: 300px; margin: auto;">
        <input type="text" name="kode" class="form-control text-center mb-2" placeholder="Masukkan kode sesi" value="<?php echo $kode ?>">
        <?php if ($error) {?><div class="text-danger mb-2"><?php echo $error ?></div><?php }?>
        <button type="submit" class="btn btn-primary w-100">Join</button>
    </form>
</div>
</body>
</html>
