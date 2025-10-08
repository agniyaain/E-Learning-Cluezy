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
<!doctype html>
<html lang="en">
<head>
    <title>Edit Quiz</title>
    <link rel="stylesheet" href="../assets/css/tambah_quiz.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <script>
    function updateJumlahSoal() {
        const container = document.getElementById('questionsContainer');
        const count = container.children.length;
        document.getElementById('jumlah_soal').value = count;
        console.log('Jumlah soal updated:', count);

        // Tampilkan warning jika tidak ada soal
        if (count === 0) {
            alert('PERINGATAN: Quiz harus memiliki setidaknya 1 soal!');
        }
    }

    function addQuestion(existingData = null) {
        const container = document.getElementById('questionsContainer');
        const count = container.children.length + 1;
        const id = existingData ? existingData.id_soal : Date.now(); // Gunakan ID soal jika ada

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
        updateJumlahSoal(); // PASTIKAN INI DIPANGGIL
    }

    function removeQuestion(id) {
        const card = document.querySelector(`.question-card[data-id="${id}"]`);
        if(card) {
            if (confirm('Yakin hapus soal ini?')) {
                card.remove();
                updateJumlahSoal(); // PASTIKAN INI DIPANGGIL
            }
        }
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

        // Final update setelah semua soal dimuat
        setTimeout(() => {
            updateJumlahSoal();
            console.log('Final jumlah soal:', document.getElementById('jumlah_soal').value);
        }, 500);
    }
</script>
</head>
<body>
<div class="container py-4">
    <h2>Edit Quiz</h2>
    <form method="POST" action="update_quiz.php" onsubmit="return validateForm()">
    <input type="hidden" name="id_quiz" value="<?php echo $quiz['id_quiz'] ?>">

    <div class="mb-3">
        <label for="judul" class="form-label">Title</label>
        <input type="text" id="judul" name="judul" class="form-control" value="<?php echo $quiz['judul'] ?>" required>
    </div>

    <div class="mb-3">
        <label for="deskripsi" class="form-label">Description</label>
        <textarea id="deskripsi" name="deskripsi" class="form-control"><?php echo $quiz['deskripsi'] ?></textarea>
    </div>

    <h4>Questions</h4>
    <!-- PASTIKAN INPUT INI ADA DAN TERISI -->
    <input type="hidden" name="jumlah_soal" id="jumlah_soal" value="">

    <div id="questionsContainer"></div>

    <button type="button" class="btn btn-secondary mb-3" onclick="addQuestion()">Add Question</button>
    <br>

    <button type="submit" class="btn btn-primary">Update Quiz</button>
    <a href="quiz.php" class="btn btn-secondary">Cancel</a>
</form>
</div>
</body>
</html>
