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
                header("Location: ../admin/index_admin.php");
            } else {
                header("Location: ../user/index.php");
            }
            exit;
        } else {
            $error = "DEBUG: Login passed but SESSION failed to start.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="login.css">
    <title>Login</title>
</head>
<body>
<section class="h-100vh gradient-form" style="background-color: #eee;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-xl-10">
                <div class="card rounded-3 text-black">
                    <div class="row g-0">
                        <div class="col-lg-6">
                            <div class="card-body p-md-5 mx-md-4">
                                <?php if(isset($error)): ?>
                                    <div class="alert alert-danger p-2 small text-center"><?= $error ?></div>
                                <?php endif; ?>

                                <form action="login.php" method="POST">
                                    <p class="text-center mb-4">Please login to your account</p>
                                    
                                    <div data-mdb-input-init class="form-outline mb-4">
                                        <input type="email" id="email" name="email" class="form-control" required />
                                        <label class="form-label" for="email">Email</label>
                                    </div>

                                    <div data-mdb-input-init class="form-outline mb-4">
                                        <input type="password" name="password" id="password" class="form-control" required />
                                        <label class="form-label" for="password">Password</label>
                                    </div>

                                    <div class="text-center pt-1 mb-5 pb-1">
                                        <button class="btn btn-primary btn-block gradient-custom-2 mb-3" type="submit">Log in</button>
                                    </div>

                                    <div class="d-flex align-items-center justify-content-center pb-4">
                                        <p class="mb-0 me-2">Don't have an account?</p>
                                        <a href="register.php" class="btn btn-outline-info">Create new</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                            <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                                <h4 class="mb-4">Intelligent Stock & Sales</h4>
                                <p class="small mb-0">Real-time data for your cleaning distribution business.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.umd.min.js"></script>
</body>
</html>