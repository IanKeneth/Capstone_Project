<?php
require_once "conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
    $role = trim($_POST['role']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO users (name, email, role, password) VALUES (?, ?, ?, ?)");
    if ($stmt->execute([$name, $email, $role, $password])) {
        header("Location: ../admin/dashboard.php");
        exit;
    } else {
        echo "Error creating user.";
    }
}
?>