<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Make Quiz</title>
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
    </style>
</head>

<body>

    <div class="container signup-container">
        <div class="row signup-box w-100">
            <div class="col-12 signup-form">
                <h2 class="fw-bold mb-4">Tambah Quiz</h2>

                <?php if (isset($error)) { ?>
                    <div class="alert alert-danger"><?php echo $error ?></div>
                <?php } ?>

                <form method="POST" action="simpan_quizdash.php">
                    <!-- Judul Field -->
                    <div class="form-group mb-3">
                        <label class="form-label">Judul Quiz</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-pencil-square"></i></span>
                            <input type="text" class="form-control" name="judul" placeholder="Enter Judul Quiz" required>
                        </div>
                    </div>

                    <!-- Deskripsi Field -->
                    <div class="form-group mb-4">
                        <label class="form-label">Deskripsi</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-text-left"></i></span>
                            <textarea class="form-control" name="deskripsi" placeholder="Enter Deskripsi Quiz" rows="3"></textarea>
                        </div>
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

                    <!-- Hidden field for question count -->
                    <input type="hidden" name="jumlah_soal" id="jumlah_soal">

                    <!-- Buttons -->
                    <div class="form-group button-group">
                        <button type="submit" class="btn submit">SIMPAN QUIZ</button>
                        <a href="quiz.php" class="btn batal">BATAL</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function updateJumlahSoal() {
            const count = document.getElementById('questionsContainer').children.length;
            document.getElementById('jumlah_soal').value = count;
        }

        function addQuestion() {
            const container = document.getElementById('questionsContainer');
            const count = container.children.length + 1;
            const id = Date.now();

            const questionHTML = `
        <div class="card mb-3 question-card" data-id="${id}">
            <div class="card-body">
                <h5 class="mb-3">Pertanyaan ${count}</h5>
                
                <!-- Question Text -->
                <div class="form-group mb-3">
                    <label class="form-label">Teks Pertanyaan</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-chat-question"></i></span>
                        <input type="text" class="form-control" placeholder="Masukkan teks pertanyaan" name="soal[${id}][soal]" required>
                    </div>
                </div>

                <!-- Choices -->
                <div class="form-group mb-3">
                    <label class="form-label">Pilihan Jawaban</label>
                    <div class="row g-2">
                        <div class="col-12 mb-2">
                            <div class="input-group">
                                <span class="input-group-text">A</span>
                                <input type="text" class="form-control" placeholder="Pilihan A" name="soal[${id}][a]" required>
                            </div>
                        </div>
                        <div class="col-12 mb-2">
                            <div class="input-group">
                                <span class="input-group-text">B</span>
                                <input type="text" class="form-control" placeholder="Pilihan B" name="soal[${id}][b]" required>
                            </div>
                        </div>
                        <div class="col-12 mb-2">
                            <div class="input-group">
                                <span class="input-group-text">C</span>
                                <input type="text" class="form-control" placeholder="Pilihan C" name="soal[${id}][c]" required>
                            </div>
                        </div>
                        <div class="col-12 mb-2">
                            <div class="input-group">
                                <span class="input-group-text">D</span>
                                <input type="text" class="form-control" placeholder="Pilihan D" name="soal[${id}][d]" required>
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
                            <option value="a">A</option>
                            <option value="b">B</option>
                            <option value="c">C</option>
                            <option value="d">D</option>
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

        window.onload = () => {
            addQuestion();
            updateJumlahSoal();
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>