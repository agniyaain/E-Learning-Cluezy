<?php
    session_start();
    include "koneksi.php";

    $id_session = $_GET['id_session'] ?? 0;
    $session    = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM quiz_session WHERE id_session='$id_session'"));

    if (! $session) {
        die("Session tidak ditemukan");
    }

    $peserta = mysqli_query($koneksi, "
    SELECT u.username
    FROM user_session us
    JOIN user u ON us.id_user = u.id_user
    WHERE us.id_session='$id_session'
");

    $quiz = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM quiz WHERE id_quiz='{$session['id_quiz']}'"));
?>
<!doctype html>
<html lang="en">
<head>
    <title>Session Lobby</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/css/det_quiz.css">
</head>
<body class="bg-light">
<div class="container text-center py-5">
    <h3 class="fw-bold"><?php echo $quiz['judul'] ?></h3>
    <h1 class="display-3 fw-bold my-4" id="textToCopy"><?php echo $session['kode_session'] ?>
    <!-- <button onclick="copyToClipboard()"><i class="bi bi-copy" onclick=""></i></button> -->
    </h1>
    <p class="text-muted">Bagikan kode ini ke orang lain untuk join quiz</p>

    <div class="mt-4 text-start mx-auto" style="max-width: 400px;">
        <h5 class="fw-bold mb-2">👥 Peserta yang sudah join:</h5>
        <ul class="list-group">
            <?php while ($p = mysqli_fetch_assoc($peserta)): ?>
                <li class="list-group-item"><?php echo htmlspecialchars($p['username']) ?></li>
            <?php endwhile; ?>
        </ul>
    </div>

    <a href="mulai_session.php?id_session=<?php echo $id_session ?>" class="btn btn-success mt-3">Mulai Quiz 🚀</a>
</div>

<script>
function copyToClipboard(){
const textField = document.getElementById('textToCopy');

textField.select();
// textField.setSelectionRange(0, 99999);

 navigato.clipboard.writeText('textToCopy')
 .then(() => {
console.log('Text copied to Clipboard');
alert ('Text copied to Clipboard: ' + 'textToCopy');
 })
 .catch(err => {
console.error('Failed to copy text: ', err);
 });
}

</script>
</body>
</html>

