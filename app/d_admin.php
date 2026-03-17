<?php require 'conn.php';
 try { 
    $pdo->exec("TRUNCATE TABLE users");
    $name = "Admin";
    $email = "admin@gmail.com";
    $password = "Admin123";
    $role = "admin";

    $password = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
        $stmt->execute([$name, $email, $password, $role]);
        }catch (PDOException $e) {
            echo "Error: " . $e->getMessage(); 
}
?>