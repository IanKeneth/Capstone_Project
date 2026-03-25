<?php
require_once 'conn.php'; // This loads your .env and PDO connection

try {
    // We run a simple query to check the database version
    $query = $pdo->query("SELECT VERSION() as version");
    $row = $query->fetch();

    echo "<div style='padding: 20px; background: #d4edda; color: #155724; border: 1px solid #c3e6cb; border-radius: 5px; font-family: sans-serif;'>";
    echo "<strong>✅ Success!</strong> Your PHP app is connected to the database.<br>";
    echo "Database Version: " . e($row['version']);
    echo "</div>";

} catch (PDOException $e) {
    echo "<div style='padding: 20px; background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; border-radius: 5px; font-family: sans-serif;'>";
    echo "<strong>❌ Connection Failed!</strong><br>";
    echo "Error: " . e($e->getMessage());
    echo "</div>";
}
?>