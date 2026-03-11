<?php
require_once "../app/conn.php"; 

//Get the ID from the URL (GET)
$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: tables.php");
    exit;
}

// Prepare the DELETE statement
$sql = "DELETE FROM users WHERE id = :id";
$stmt = $pdo->prepare($sql);

// Execute and Redirect
try {
    if ($stmt->execute(['id' => $id])) {
        echo "<script>
                alert('User account deleted successfully.');
                window.location.href='tables.php';
                </script>";
    } else {
        echo "<script>
                alert('Error: Could not delete user.');
                window.location.href='tables.php';
                </script>";
    }
} catch (PDOException $e) {
    // This catches errors like Foreign Key constraints
    echo "<script>
            alert('Database Error: " . addslashes($e->getMessage()) . "');
            window.location.href='tables.php';
            </script>";
}
?>