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
    <link rel="stylesheet" href="../assets/css/user_dash.css">
    <style>
        .question-card {
            border: 1px solid #dee2e6;
            border-radius: 8px;
        }

        .question-card .card-body {
            padding: 20px;
        }

        .current-files .file-item {
            padding: 8px 12px;
            background: #f8f9fa;
            border-radius: 5px;
            border: 1px solid #e9ecef;
        }
    </style>
</head>

<body>

    <div class="container signup-container">
        <div class="row signup-box w-100">
            <div class="col-12 signup-form">
                <h2 class="fw-bold mb-4">Edit Quiz</h2>

                <form method="POST" action="update_quizdas.php" onsubmit="return validateForm()">
                    <input type="hidden" name="id_quiz" value="<?php echo $quiz['id_quiz'] ?>">

                    <!-- Judul Field -->
                    <div class="form-group mb-3">
                        <label class="form-label">Judul Quiz</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-pencil-square"></i></span>
                            <input type="text" class="form-control" name="judul" value="<?php echo htmlspecialchars($quiz['judul']); ?>" placeholder="Enter Judul Quiz" required>
                        </div>
                    </div>

                    <!-- Deskripsi Field -->
                    <div class="form-group mb-4">
                        <label class="form-label">Deskripsi</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-text-left"></i></span>
                            <textarea class="form-control" name="deskripsi" placeholder="Enter Deskripsi Quiz" rows="3"><?php echo htmlspecialchars($quiz['deskripsi']); ?></textarea>
                        </div>
                    </div>

                    <!-- Jumlah Soal Info -->
                    <div class="form-group mb-3">
                        <label class="form-label">Jumlah Soal</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-list-ol"></i></span>
                            <input type="text" class="form-control" id="jumlah_soal" name="jumlah_soal" readonly>
                        </div>
                        <small class="form-text text-muted">Jumlah soal akan terupdate otomatis saat menambah/menghapus soal</small>
                    </div>

                    <!-- Questions Section -->
                    <h4 class="mb-3">Pertanyaan</h4>
                    <div id="questionsContainer"></div>

                    <!-- Add Question Button -->
                    <div class="form-group mb-4">
                        <button type="button" class="btn btn-secondary" onclick="addQuestion()">
                            <i class="bi bi-plus-circle"></i> Tambah Pertanyaan
                        </button>
                    </div>

                    <!-- Buttons -->
                    <div class="form-group button-group">
                        <button type="submit" class="btn submit">UPDATE QUIZ</button>
                        <a href="quiz_dash.php" class="btn batal">BATAL</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

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
                <h5 class="mb-3">Pertanyaan ${count}</h5>
                <input type="hidden" name="soal[${id}][id_soal]" value="${existingData ? existingData.id_soal : ''}">
                
                <!-- Question Text -->
                <div class="form-group mb-3">
                    <label class="form-label">Teks Pertanyaan</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-chat-question"></i></span>
                        <input type="text" class="form-control" placeholder="Masukkan teks pertanyaan" name="soal[${id}][soal]" value="${soal}" required>
                    </div>
                </div>

                <!-- Choices -->
                <div class="form-group mb-3">
                    <label class="form-label">Pilihan Jawaban</label>
                    <div class="row g-2">
                        <div class="col-12 mb-2">
                            <div class="input-group">
                                <span class="input-group-text">A</span>
                                <input type="text" class="form-control" placeholder="Pilihan A" name="soal[${id}][a]" value="${a}" required>
                            </div>
                        </div>
                        <div class="col-12 mb-2">
                            <div class="input-group">
                                <span class="input-group-text">B</span>
                                <input type="text" class="form-control" placeholder="Pilihan B" name="soal[${id}][b]" value="${b}" required>
                            </div>
                        </div>
                        <div class="col-12 mb-2">
                            <div class="input-group">
                                <span class="input-group-text">C</span>
                                <input type="text" class="form-control" placeholder="Pilihan C" name="soal[${id}][c]" value="${c}" required>
                            </div>
                        </div>
                        <div class="col-12 mb-2">
                            <div class="input-group">
                                <span class="input-group-text">D</span>
                                <input type="text" class="form-control" placeholder="Pilihan D" name="soal[${id}][d]" value="${d}" required>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Correct Answer -->
                <div class="form-group mb-3">
                    <label class="form-label">Jawaban Benar</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-check-circle"></i></span>
                        <select class="form-select" name="soal[${id}][jawaban_benar]" required>
                            <option value="a" ${jawaban === "a" ? "selected" : ""}>A</option>
                            <option value="b" ${jawaban === "b" ? "selected" : ""}>B</option>
                            <option value="c" ${jawaban === "c" ? "selected" : ""}>C</option>
                            <option value="d" ${jawaban === "d" ? "selected" : ""}>D</option>
                        </select>
                    </div>
                </div>

                <!-- Remove Button -->
                <button type="button" class="btn btn-danger btn-sm" onclick="removeQuestion(${id})">
                    <i class="bi bi-trash"></i> Hapus Pertanyaan
                </button>
            </div>
        </div>
        `;

            container.insertAdjacentHTML('beforeend', questionHTML);
            updateJumlahSoal();
        }

        function removeQuestion(id) {
            const card = document.querySelector(`.question-card[data-id="${id}"]`);
            if (card) {
                if (confirm('Yakin hapus soal ini?')) {
                    card.remove();
                    updateJumlahSoal();
                    // Re-number remaining questions
                    const questions = document.querySelectorAll('.question-card');
                    questions.forEach((card, index) => {
                        const title = card.querySelector('h5');
                        if (title) {
                            title.textContent = `Pertanyaan ${index + 1}`;
                        }
                    });
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
            const soalData = <?php echo json_encode($soal) ?>;
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>