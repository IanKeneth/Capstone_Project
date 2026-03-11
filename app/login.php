<?php
require 'conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
    $password = htmlspecialchars(trim($_POST['password']));

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    //check if user exists and password is correct
    if (!$user) {
        $error = "invalid email ";
    } elseif (!password_verify($password, $user['password'])) {
        $error = "Error password";
    } else {
        // SUCCESS - SET SESSIONS
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['name'] = $user['name'];

        //check if session actually saved, then redirect based on role
        if (isset($_SESSION['user_id'])) {
            if ($user['role'] === 'admin') {
                header("Location: http://localhost:8000");
            } else {
                header("Location: ../user/index.php");
            }
            exit;
        } else {
            $error = "SESSION failed to start.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Log-in Page</title>
    <style>
        *{
    padding: 0;
    margin: 0;
    font-family: sans-serif;

    }

    body{
        background-image:  url("../app/img/gm.jpg") ;
        background-size: cover;

    }

    .login-form{
        padding: 60px;
        background-color:grey;
        opacity: 0.8;
        border-radius: 50px;
        width: 330px;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        position: absolute;
        color:white;
    }

    .login-form h1{
        font-size: 20px;
        text-align: center;
        text-transform: uppercase;
        margin: 20px 0;
    }

    .login-form p{
        font-size: 20px;
        margin: 15px 0;
    }

    .login-form input{
        font-size: 16px;
        width: 90%;
        padding: 10px 10px;
        border: 0;
        outline: none;
        border-radius: 5px;
    }

    .login-form button{
        font-size: 10;
        font-weight: bold;
        margin: 20px;width: 20px 0;
        border-radius: 5px;
        border: 0;
        padding: 10px  15px;
    }
    a{
        color: black;
        background-color: white;
        font-size:20px;
        text-decoration: none;
        margin: 5px;
        width: 20px 0;
        padding: 5px  10px;
    }

    </style>
</head>
<body>
    <div class = "login-form">
        <h1>Login Your Account Here</h1>
        <form action="login.php" method = "POST">
            <p> <i class="fa fa-envelope-o"></i>Email</p>
            <input type = "email" name = "email" placeholder="Enter Email" required>

            <p> <i class="fa fa-key"></i>Password</p>
            <input type="Password" name="password" placeholder="Enter Password" required>
            </p>
            <button type="submit">LOGIN</button>
            <div>
                <p>You D'ont have an Account?</p>
                <a href="register.php">Register Here</a>
            </div>
        </form>
    </div>
    
</body>
</html>