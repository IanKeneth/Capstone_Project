<?php
require 'conn.php'; // conn.php already has session_start()

$error = "";
$success = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and trim inputs
    $name = htmlspecialchars(trim($_POST['name']));
    $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';
    $confirm_password = isset($_POST['confirm_password']) ? trim($_POST['confirm_password']) : '';

    // Validate inputs
    if (empty($name)) {
        $error = "Full Name cannot be empty!";
    } elseif (!$email) {
        $error = "Invalid email address!";
    } elseif (empty($password) || empty($confirm_password)) {
        $error = "Password fields cannot be empty!";
    } elseif ($password !== $confirm_password) {
        $error = "Passwords do not match!";
    } elseif (strlen($password) < 6) {
        $error = "Password must be at least 6 characters long!";
    } else {
        try {
            // Check if email already exists
            $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
            $stmt->execute([$email]);

            if ($stmt->rowCount() > 0) {
                $error = "This email is already registered!";
            } else {
                // Force role to 'user'
                $role = 'user';
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                // Insert into database
                $insert = $pdo->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
                if ($insert->execute([$name, $email, $hashed_password, $role])) {
                    $success = "Registration successful! You can now log in.";
                    // Clear POST data to prevent resubmission
                    $_POST = [];
                } else {
                    $error = "Failed to register user: " . implode(", ", $insert->errorInfo());
                }
            }
        } catch (PDOException $e) {
            $error = "Database error: " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Register - ISSA Portal</title>
<style>
*{padding:0;margin:0;font-family:sans-serif;}
body{background-image:url("../app/img/gm.jpg");background-size:cover;}
.login-form{
    padding:30px;
    background-color:rgba(128,128,128,0.8);
    border-radius:50px;
    width:400px;
    top:50%;
    left:50%;
    transform:translate(-50%, -50%);
    position:absolute;
    color:white;
}
.login-form h1{text-align:center;text-transform:uppercase;margin:20px 0;}
.login-form input{font-size:16px;width:90%;padding:10px;border-radius:5px;border:0;outline:none;}
.login-form button{font-size:16px;font-weight:bold;margin:20px 0;border-radius:5px;border:0;padding:10px 15px;}
.login-form .btn a{color:black;background-color:white;text-decoration:none;padding:5px 10px;border-radius:5px;}
.alert{padding:10px;margin-bottom:15px;border-radius:5px;}
.alert-danger{background-color:#f8d7da;color:#842029;}
.alert-success{background-color:#d1e7dd;color:#0f5132;}
</style>
</head>
<body>
<div class="login-form">
    <?php if($error): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <?php if($success): ?>
        <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>

    <h1>Register Your Account Here</h1>
    <form action="register.php" method="POST">
        <p>Full Name</p>
        <input type="text" name="name" placeholder="Full Name" value="<?= isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '' ?>" required>

        <p>Email</p>
        <input type="email" name="email" placeholder="Enter Email" value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>" required>

        <p>Password</p>
        <input type="password" name="password" placeholder="Enter Password" required>

        <p>Confirm Password</p>
        <input type="password" name="confirm_password" placeholder="Confirm Password" required>

        <button type="submit">REGISTER</button>
        <div class="btn">
            <p class="mb-0 me-2">Already have an account?</p>
            <a href="login.php">Login</a>
        </div>
    </form>
</div>
</body>
</html>