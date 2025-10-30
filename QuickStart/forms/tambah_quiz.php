<!doctype html>
<html lang="en">

<head>
    <title>Make Quiz</title>
    <link rel="stylesheet" href="../assets/css/tambah_quiz.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>

    </style>
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
                <h5>Question ${count}</h5>
                <div class="mb-3">
                    <input type="text" class="form-control" placeholder="Question text" name="soal[${id}][soal]" required>
                </div>
                <div class="row g-2 mb-3">
                    <div class="col-6"><input type="text" class="form-control" placeholder="Choice A" name="soal[${id}][a]" required></div>
                    <div class="col-6"><input type="text" class="form-control" placeholder="Choice B" name="soal[${id}][b]" required></div>
                    <div class="col-6"><input type="text" class="form-control" placeholder="Choice C" name="soal[${id}][c]" required></div>
                    <div class="col-6"><input type="text" class="form-control" placeholder="Choice D" name="soal[${id}][d]" required></div>
                </div>
                <div class="mb-3">
                    <label>Correct Answer:</label>
                    <select class="form-select" name="soal[${id}][jawaban_benar]" required>
                        <option value="a">A</option>
                        <option value="b">B</option>
                        <option value="c">C</option>
                        <option value="d">D</option>
                    </select>
                </div>
                <button type="button" class="btn btn-danger btn-sm" onclick="removeQuestion(${id})">Remove Question</button>
            </div>
        </div>
        `;

            container.insertAdjacentHTML('beforeend', questionHTML);
            updateJumlahSoal(); // TAMBAH INI
        }

        function removeQuestion(id) {
            const card = document.querySelector(`.question-card[data-id="${id}"]`);
            if (card) {
                card.remove();
                updateJumlahSoal(); // TAMBAH INI
            }
        }

        window.onload = () => {
            addQuestion();
            updateJumlahSoal(); // TAMBAH INI
        }
    </script>
</head>

<body>
    <div class="container py-4">
        <h2>Create New Quiz</h2>
        <?php if (isset($error)) { ?>
            <div class="alert alert-danger"><?php echo $error ?></div>
        <?php } ?>
        <form method="POST" action="simpan_quiz.php">
            <div class="mb-3">
                <label for="judul" class="form-label">Title</label>
                <input type="text" id="judul" name="judul" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="deskripsi" class="form-label">Description</label>
                <textarea id="deskripsi" name="deskripsi" class="form-control"></textarea>
            </div>

            <h4>Questions</h4>
            <div id="questionsContainer"></div>

            <button type="button" class="btn btn-secondary mb-3" onclick="addQuestion()">Add Question</button>

            <br>
            <input type="hidden" name="jumlah_soal" id="jumlah_soal">
            <button type="submit" class="btn btn-primary">Save Quiz</button>
            <a href="quiz.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>

</html>