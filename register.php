<?php
session_start();
require_once "db.php";

$error = "";
$success = "";

if (isset($_POST["register"])) {
    $full_name = trim($_POST["full_name"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    if (empty($full_name) || empty($email) || empty($password) || empty($confirm_password)) {
        $error = "Please fill in all fields!";
    } 
  
    elseif ($password !== $confirm_password) {
        $error = "Passwords do not match!";
    } 
    else {
       
        $check_sql = "SELECT id FROM users WHERE email = ?";
        $check_stmt = mysqli_prepare($conn, $check_sql);
        mysqli_stmt_bind_param($check_stmt, "s", $email);
        mysqli_stmt_execute($check_stmt);
        mysqli_stmt_store_result($check_stmt);

        if (mysqli_stmt_num_rows($check_stmt) > 0) {
            $error = "Email address is already registered!";
        } else {
          
            $password_hash = password_hash($password, PASSWORD_DEFAULT);

           
            $insert_sql = "INSERT INTO users (full_name, email, password_hash) VALUES (?, ?, ?)";
            $insert_stmt = mysqli_prepare($conn, $insert_sql);
            mysqli_stmt_bind_param($insert_stmt, "sss", $full_name, $email, $password_hash);

            if (mysqli_stmt_execute($insert_stmt)) {
                $success = "Registration successful! You can now <a href='index.php'>log in</a>.";
            } else {
                $error = "An error occurred. Please try again.";
            }

            mysqli_stmt_close($insert_stmt);
        }
        mysqli_stmt_close($check_stmt);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="login-wrapper">
        <div class="login-box">
            <h2>Create Account</h2>

            <?php if ($error != "") { ?>
                <p class="error"><?php echo $error; ?></p>
            <?php } ?>

            <?php if ($success != "") { ?>
                <p class="success-msg" style="background-color: rgba(16, 185, 129, 0.2); color: #34d399; padding: 12px; border-radius: 10px; font-size: 14px; margin-bottom: 20px; text-align: center; border: 1px solid rgba(16, 185, 129, 0.4);"><?php echo $success; ?></p>
            <?php } ?>

            <form method="POST" action="">
                <div class="form-group">
                    <label for="full_name">Full Name</label>
                    <input type="text" id="full_name" name="full_name" placeholder="Enter your full name" required>
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Create a password" required>
                </div>

                <div class="form-group">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" id="confirm_password" name="confirm_password" placeholder="Re-enter your password" required>
                </div>

                <button type="submit" name="register" class="btn-submit">Register</button>
            </form>

            <div class="login-footer">
                <p>Already have an account? <a href="index.php">Log In</a></p>
            </div>
        </div>
    </div>

</body>
</html>