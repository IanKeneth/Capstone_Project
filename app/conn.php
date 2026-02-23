<?php
// Start a session so the server remembers who is logged in
session_start();

$host = "localhost";
$dbname = "issa_system";
$username = "root";
$password = "";

try {
    // Create the connection using PDO for security
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Security function to prevent "XSS" cross cite scripting attacks
function e($text) {
    return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}
?>