<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="dashboard-wrapper">
        <div class="dashboard-card">
            <h1>Welcome, <?php echo htmlspecialchars($_SESSION["full_name"]); ?>! </h1>
            <p class="subtitle">You have successfully logged in to your student account.</p>

            <div class="user-info-box">
                <p><strong>User ID:</strong> <?php echo htmlspecialchars($_SESSION["user_id"]); ?></p>
                <p><strong>Status:</strong> <span class="badge">Active</span></p>
            </div>

            <div class="dashboard-actions">
                <a href="logout.php" class="btn-logout">Log Out</a>
            </div>
        </div>
    </div>

</body>
</html>