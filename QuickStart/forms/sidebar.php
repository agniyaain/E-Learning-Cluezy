<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/css/notedash.css">
</head>

<body>
    <button class="sidebar-toggle" id="sidebarToggle">
        <i class="bi bi-list"></i>
    </button>

    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <div class="sidebar d-flex flex-column position-fixed top-0 start-0 h-100 col-md-3 col-lg-2 p-0" id="sidebar">
        <div class="logo text-center py-3 border-bottom">
            <h4 class="text-white mb-0"><i class="bi bi-layout-sidebar-inset"></i> My App</h4>
        </div>

        <div class="user-info text-center border-bottom py-3">
            <img src="../assets/img/ayinadmin.jpg" alt="User" class="img-fluid rounded-circle mb-2 border border-light-subtle">
            <h6 class="text-white mb-0"><?php echo $_SESSION['username'] ?? 'Admin'; ?></h6>
            <small class="text-light-emphasis text-white">Administrator</small>
        </div>

        <nav class="nav flex-column p-3">
            <a class="nav-link text-white" href="dashboard_admin.php"><i class="bi bi-speedometer2"></i> Dashboard</a>
            <a class="nav-link text-white" href="user_dash.php"><i class="bi bi-people"></i> Users</a>
            <a class="nav-link text-white" href="note_dash.php"><i class="bi bi-file-earmark-text"></i> Note</a>
            <a class="nav-link text-white" href="quiz_dash.php"><i class="bi bi-grid"></i> Quiz</a>
            <a class="nav-link text-danger" href="logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a>
        </nav>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebarOverlay = document.getElementById('sidebarOverlay');
            const body = document.body;

            function toggleSidebar() {
                sidebar.classList.toggle('mobile-open');
                sidebarOverlay.classList.toggle('active');
                body.classList.toggle('sidebar-open');
            }

            sidebarToggle.addEventListener('click', toggleSidebar);
            sidebarOverlay.addEventListener('click', toggleSidebar);

            // Close sidebar when clicking on nav links (mobile)
            document.querySelectorAll('.sidebar .nav-link').forEach(link => {
                link.addEventListener('click', function() {
                    if (window.innerWidth <= 768) {
                        toggleSidebar();
                    }
                });
            });

            // Handle window resize
            window.addEventListener('resize', function() {
                if (window.innerWidth > 768) {
                    sidebar.classList.remove('mobile-open');
                    sidebarOverlay.classList.remove('active');
                    body.classList.remove('sidebar-open');
                }
            });
        });
    </script>
</body>

</html>