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
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="dashboard-wrapper">
        <div class="dashboard-card">
            <h1>Welcome, <?php echo htmlspecialchars($_SESSION["full_name"]); ?>! 🎉</h1>
            <p class="subtitle">You have successfully logged in to your account.</p>

            <div class="user-info-box">
                <p><strong>User ID:</strong> <?php echo htmlspecialchars($_SESSION["user_id"]); ?></p>
                <p><strong>Role:</strong> 
                    <span class="badge role-badge">
                        <?php echo ucfirst(htmlspecialchars($_SESSION["role"] ?? 'student')); ?>
                    </span>
                </p>
                <p><strong>Status:</strong> <span class="badge active-badge">Active</span></p>
            </div>

            <!-- Optional: Show Admin specific tools if the role is admin -->
            <?php if (isset($_SESSION["role"]) && $_SESSION["role"] === 'admin'): ?>
                <div class="admin-panel-notice" style="margin-bottom: 20px; font-size: 14px; color: #a78bfa;">
                    🔒 Admin privileges unlocked.
                </div>
            <?php endif; ?>