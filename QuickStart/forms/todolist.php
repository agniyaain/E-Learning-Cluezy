<!-- todolist.php -->
<?php
    session_start();
    include "koneksi.php";

    if (! isset($_SESSION['id_user'])) {
        header("Location: login.php");
        exit;
    }

    $id_user = $_SESSION['id_user'];
    $sql     = "SELECT * FROM to_do_list WHERE id_user='$id_user'";
    $result  = mysqli_query($koneksi, $sql);
    include "header.php";
    include "navigasi.php";
?>
<div class="todo-list">
<div class="container mt-5">
    <div class="todo-card">
        <h2 class="mb-4 text-center">My ToDo List 📝</h2>

        <form action="tambah_todo.php" method="POST" class="row g-3 mb-4">
            <input type="hidden" name="id_todo" id="id_todo">
            <div class="col-md-6">
                <label class="form-label">Task</label>
                <input type="text" name="kegiatan" class="form-control" placeholder="Add new task">
            </div>
            <div class="col-md-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select ">
                    <?php
                        include "koneksi.php";
                        $query  = "select * from status_todo ORDER BY FIELD(status, 'Not Yet', 'Doing', 'Done')";
                        $result = mysqli_query($koneksi, $query);
                        while ($data = mysqli_fetch_assoc($result)) {
                            echo "<option value='" . $data['status'] . "'>" . $data['status'] . "</option>";
                        }
                    ?>
                </select>
            </div>

            <div class="col-md-3 d-flex align-items-end">
                <button type="submit" name="add_kegiatan" class="btn btn-primary w-100">+ Add Task</button>
            </div>
        </form>

        <table class="table table-bordered table-hover align-middle justify-content-center">
            <thead>
                <tr>
                    <th style="width:100px; background: #a7948bff;">Status</th>
                    <th style="background: #a7948bff;">Task</th>

                </tr>
            </thead>
            <tbody>
                <?php

                    include "koneksi.php";
                    $id_user = $_SESSION['id_user'];
                    $query   = "SELECT *FROM to_do_list where id_user = '$id_user' ";
                    $data    = mysqli_query($koneksi, $query);
                    while ($dt = mysqli_fetch_assoc($data)) {
                        $rowClass = '';
                        if ($dt['status'] == 'Not Yet') {
                            $rowClass = 'table-danger';
                        } elseif ($dt['status'] == 'Doing') {
                            $rowClass = 'table-warning';
                        } elseif ($dt['status'] == 'Done') {
                            $rowClass = 'table-success';
                        }
                        echo "<tr>";
                        echo "<td class='$rowClass text-center'>" . $dt['status'] . "</td>";
                        echo "<td>
                                    <div class='d-flex justify-content-between align-items-center'>
                                        <span>" . $dt['kegiatan'] . "</span>
                                        <div class='dropdown'>
                                        <a href='#' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
                                            <img src='../assets/img/bar-3.png' alt='action' style='width: 20px; cursor:pointer;'>
                                        </a>
                                        <ul class='dropdown-menu dropdown-menu-end'>
                                            <li><a class='dropdown-item' href='edit_todo.php?id_todo=" . $dt['id_todo'] . "'>Edit</a></li>
                                            <li><a class='dropdown-item text-danger' href='delete_todo.php?id_todo=" . $dt['id_todo'] . "' onclick=\"return confirm('Do you agree delete this task');\">Delete</a></li>
                                        </ul>
                                        </div>
                                    </div>
                                </td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>
</div>
</body>
<?php include "footer.php"; ?>

</html>