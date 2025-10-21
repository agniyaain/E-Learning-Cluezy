<!-- Sidebar Component -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
   <style>
.sidebar {
    background: linear-gradient(180deg, #2c3e50 0%, #3498db 100%);
    overflow-y: auto;
    scrollbar-width: thin;
}
.sidebar .nav-link:hover {
    background-color: rgba(255, 255, 255, 0.1);
    transform: translateX(5px);
}
.sidebar .nav-link.active {
    background-color: #e74c3c;
}
</style>
</head>
<body>


<div class="sidebar d-flex flex-column position-fixed top-0 start-0 h-100 col-md-3 col-lg-2 p-0">
    <div class="logo text-center py-3 border-bottom">
        <h4 class="text-white mb-0"><i class="bi bi-layout-sidebar-inset"></i> My App</h4>
    </div>

    <div class="user-info text-center border-bottom py-3">
        <img src="../assets/img/ayinadmin.jpg" alt="User" class="img-fluid rounded-circle mb-2 border border-light-subtle">
        <h6 class="text-white mb-0"><?php echo $_SESSION['username'] ?? 'Admin'; ?></h6>
        <small class="text-light-emphasis text-white">Administrator</small>
    </div>

    <nav class="nav flex-column p-3">
        <a class="nav-link text-white active" href="dashboard_admin.php"><i class="bi bi-speedometer2"></i> Dashboard</a>
        <a class="nav-link text-white" href="user_dash.php"><i class="bi bi-people"></i> Users</a>
        <a class="nav-link text-white" href="note_dash.php"><i class="bi bi-file-earmark-text"></i> Note</a>
        <a class="nav-link text-white" href="quiz_dash.php"><i class="bi bi-grid"></i> Quiz</a>
        <a class="nav-link text-white" href="comments.php"><i class="bi bi-chat-left-text"></i> Comments</a>
        <div class="dropdown">
            <a class="nav-link text-white dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"><i class="bi bi-gear"></i> Settings</a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                <li><a class="dropdown-item" href="security.php">Security</a></li>
                <li><a class="dropdown-item" href="notifications.php">Notifications</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="system.php">System</a></li>
            </ul>
        </div>
        <a class="nav-link text-white" href="help.php"><i class="bi bi-question-circle"></i> Help</a>
        <a class="nav-link text-danger" href="logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a>
    </nav>
</div>
</body>
</html>