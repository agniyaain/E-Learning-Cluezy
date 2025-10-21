<?php
    session_start();
    include "koneksi.php";

    $id_quiz = $_GET['id_quiz'] ?? 0;

    // ambil data quiz
    $query = "SELECT * FROM quiz WHERE id_quiz = $id_quiz";
    $qQuiz = mysqli_query($koneksi, $query);
    $quiz  = mysqli_fetch_assoc($qQuiz);

    // ambil data soal
    $query2 = "SELECT * FROM soal WHERE id_quiz = $id_quiz";
    $qSoal  = mysqli_query($koneksi, $query2);
    $soal   = [];
    while ($row = mysqli_fetch_assoc($qSoal)) {
        $soal[] = $row;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Quiz</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <script>
    function updateJumlahSoal() {
        const container = document.getElementById('questionsContainer');
        const count = container.children.length;
        document.getElementById('jumlah_soal').value = count;
        console.log('Jumlah soal updated:', count);

        if (count === 0) {
            alert('PERINGATAN: Quiz harus memiliki setidaknya 1 soal!');
        }
    }

    function addQuestion(existingData = null) {
        const container = document.getElementById('questionsContainer');
        const count = container.children.length + 1;
        const id = existingData ? existingData.id_soal : Date.now();

        let soal = existingData ? existingData.soal : "";
        let a = existingData ? existingData.pilihan_a : "";
        let b = existingData ? existingData.pilihan_b : "";
        let c = existingData ? existingData.pilihan_c : "";
        let d = existingData ? existingData.pilihan_d : "";
        let jawaban = existingData ? existingData.jawaban_benar : "";

        const questionHTML = `
        <div class="card mb-3 question-card" data-id="${id}">
            <div class="card-body">
                <h5>Question ${count}</h5>
                <input type="hidden" name="soal[${id}][id_soal]" value="${existingData ? existingData.id_soal : ''}">
                <div class="mb-3">
                    <input type="text" class="form-control" placeholder="Question text" name="soal[${id}][soal]" value="${soal}" required>
                </div>
                <div class="row g-2 mb-3">
                    <div class="col-6"><input type="text" class="form-control" placeholder="Choice A" name="soal[${id}][a]" value="${a}" required></div>
                    <div class="col-6"><input type="text" class="form-control" placeholder="Choice B" name="soal[${id}][b]" value="${b}" required></div>
                    <div class="col-6"><input type="text" class="form-control" placeholder="Choice C" name="soal[${id}][c]" value="${c}" required></div>
                    <div class="col-6"><input type="text" class="form-control" placeholder="Choice D" name="soal[${id}][d]" value="${d}" required></div>
                </div>
                <div class="mb-3">
                    <label>Correct Answer:</label>
                    <select class="form-select" name="soal[${id}][jawaban_benar]" required>
                        <option value="a" ${jawaban === "a" ? "selected" : ""}>A</option>
                        <option value="b" ${jawaban === "b" ? "selected" : ""}>B</option>
                        <option value="c" ${jawaban === "c" ? "selected" : ""}>C</option>
                        <option value="d" ${jawaban === "d" ? "selected" : ""}>D</option>
                    </select>
                </div>
                <button type="button" class="btn btn-danger btn-sm" onclick="removeQuestion(${id})">Remove Question</button>
            </div>
        </div>
        `;

        container.insertAdjacentHTML('beforeend', questionHTML);
        updateJumlahSoal();
    }

    function removeQuestion(id) {
        const card = document.querySelector(`.question-card[data-id="${id}"]`);
        if(card) {
            if (confirm('Yakin hapus soal ini?')) {
                card.remove();
                updateJumlahSoal();
            }
        }
    }

    function validateForm() {
        const jumlahSoal = document.getElementById('jumlah_soal').value;
        if (jumlahSoal == 0) {
            alert('Quiz harus memiliki setidaknya 1 soal!');
            return false;
        }
        return true;
    }

    window.onload = () => {
        console.log('Loading existing questions...');
        const soalData =                         <?php echo json_encode($soal) ?>;
        console.log('Soal data:', soalData);

        if (soalData.length > 0) {
            soalData.forEach(s => {
                console.log('Adding question:', s.soal);
                addQuestion(s);
            });
        } else {
            console.log('No existing questions, adding new one');
            addQuestion();
        }

        setTimeout(() => {
            updateJumlahSoal();
            console.log('Final jumlah soal:', document.getElementById('jumlah_soal').value);
        }, 500);
    }
    </script>
</head>
<body>
    <div class="container container-fluid">
        <div class="row">
            <div class="col-md-9 col-lg-10 ms-sm-auto px-4 py-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1>Edit Quiz</h1>
                </div>
                <hr>

                <form method="POST" action="update_quizdas.php" onsubmit="return validateForm()">
                    <input type="hidden" name="id_quiz" value="<?php echo $quiz['id_quiz'] ?>">

                    <table class="table table-bordered">
                        <tr>
                            <td width="150px">Judul</td>
                            <td>
                                <input type="text" class="form-control" name="judul" value="<?php echo $quiz['judul'] ?>" required>
                            </td>
                        </tr>
                        <tr>
                            <td>Deskripsi</td>
                            <td>
                                <textarea class="form-control" name="deskripsi"><?php echo $quiz['deskripsi'] ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>Jumlah Soal</td>
                            <td>
                                <input type="text" class="form-control" id="jumlah_soal" name="jumlah_soal" readonly>
                            </td>
                        </tr>
                    </table>

                    <h4 class="mt-4">Questions</h4>
                    <div id="questionsContainer"></div>

                    <button type="button" class="btn btn-secondary mb-3" onclick="addQuestion()">Add Question</button>
                    <br>

                    <div class="mt-3">
                        <input type="submit" value="UPDATE" class="btn btn-primary">
                        <a href="quiz_dash.php" class="btn btn-secondary">BATAL</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>