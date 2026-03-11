<?php
require_once "../app/conn.php"; 

//Get the ID safely
$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: tables.php");
    exit;
}

//Process the Update
if (isset($_POST['update_role'])) {
    $new_role = trim($_POST['role']);
    
    $sql = "UPDATE users SET role = :role WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    
    if ($stmt->execute(['role' => $new_role, 'id' => $id])) {
        echo "<script>alert('Role updated successfully!');
        window.location.href='tables.php';</script>";
    } else {
        echo "<script>alert('Failed to update role.');</script>";
   }
}
//Fetch current user info
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    die("User not found.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Admin - Edit Role</title>
    <link href="css/sb-admin-2.css" rel="stylesheet">
</head>
<body class="bg-gradient-primary">
    <div class="container">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <div class="p-5">
                    <form method="POST" class="user">
                        <div class="form-group">
                            <label>Full Name</label>
                            <input type="text" class="form-control form-control-user" value="<?php echo e($user['name']); ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control form-control-user" value="<?php echo e($user['email']); ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>Current Role</label>
                            <select name="role" class="form-control">
                                <option value="admin" <?php echo $user['role'] == 'admin' ? 'selected' : ''; ?>>Admin</option>
                                <option value="user" <?php echo $user['role'] == 'user' ? 'selected' : ''; ?>>User</option>
                            </select>
                        </div>
                        <button type="submit" name="update_role" class="btn btn-primary btn-user btn-block">
                            Update Role
                        </button>
                        <hr>
                        <a href="tables.php" class="btn btn-secondary btn-user btn-block">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>