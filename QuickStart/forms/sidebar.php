<!-- Sidebar Component -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(180deg, #2c3e50 0%, #3498db 100%);
            transition: all 0.3s;
        }

        .sidebar .nav-link {
            color: #ecf0f1;
            padding: 12px 20px;
            margin: 4px 0;
            border-radius: 8px;
            transition: all 0.3s;
        }

        .sidebar .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: #ffffff;
            transform: translateX(5px);
        }

        .sidebar .nav-link.active {
            background-color: #e74c3c;
            color: #ffffff;
        }

        .sidebar .nav-link i {
            margin-right: 10px;
            font-size: 1.1rem;
         }

        .logo {
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .logo h4 {
            color: white;
            margin: 0;
            font-weight: 600;
        }

        .user-info {
            padding: 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            text-align: center;
        }

        .user-info img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            margin-bottom: 10px;
            border: 3px solid rgba(255, 255, 255, 0.2);
        }

        .user-info h6 {
            color: white;
            margin: 5px 0;
        }

        .user-info small {
            color: #bdc3c7;
        }
    </style>
</head>
<body>

<div class="col-md-3 col-lg-2 sidebar d-md-block">
    <!-- Logo -->
    <div class="logo">
        <h4><i class="bi bi-layout-sidebar-inset"></i> My App</h4>
    </div>

    <!-- User Info -->
    <div class="user-info">
        <img src="https://via.placeholder.com/60" alt="User" class="img-fluid">
        <h6><?php echo $_SESSION['username'] ?? 'Admin'; ?></h6>
        <small>Administrator</small>
    </div>

    <!-- Navigation Menu -->
    <nav class="nav flex-column p-3">
        <a class="nav-link active" href="index.php">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>
        <a class="nav-link" href="user_dash.php">
            <i class="bi bi-people"></i> Users
        </a>
        <a class="nav-link" href="note_dash.php">
            <i class="bi bi-file-earmark-text"></i> Note
        </a>
        <a class="nav-link" href="categories.php">
            <i class="bi bi-grid"></i> Categories
        </a>
        <a class="nav-link" href="comments.php">
            <i class="bi bi-chat-left-text"></i> Comments
        </a>

        <!-- Dropdown Menu -->
        <div class="dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                <i class="bi bi-gear"></i> Settings
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                <li><a class="dropdown-item" href="security.php">Security</a></li>
                <li><a class="dropdown-item" href="notifications.php">Notifications</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="system.php">System</a></li>
            </ul>
        </div>

        <a class="nav-link" href="help.php">
            <i class="bi bi-question-circle"></i> Help
        </a>
        <a class="nav-link text-danger" href="logout.php">
            <i class="bi bi-box-arrow-right"></i> Logout
        </a>
    </nav>
</div>

</body>
</html>