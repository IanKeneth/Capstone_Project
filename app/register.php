<?php
require 'conn.php';

$error = "";
$success = "";

//validate and sanitize input field
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
    $password = htmlspecialchars(trim($_POST['password']));
    $confirm_password = htmlspecialchars(trim($_POST['confirm_password']));

    //If passwords don't match, stop here.
    if ($password !== $confirm_password) {
        $error = "Passwords do not match!";
    } else {
        //Check if the email is already use or taken by another user, We want unique emails for each account.
        $check = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $check->execute([$email]);
        
        if ($check->rowCount() > 0) {
            $error = "This email is already registered!";
        } else {
            //  We force the role to user only .
            $role = 'user';
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert user into the database using prepared statements to prevent SQL injection
            $stmt = $pdo->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
            if ($stmt->execute([$name, $email, $hashed_password, $role])) {
                $success = "Registration successful! You can now log in.";
            } else {
                $error = "Something went wrong. Please try again.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.min.css" rel="stylesheet" />
    <title>Register - ISSA Portal</title>
</head>
<body>
<section class="h-100 gradient-form" style="background-color: #eee;">
    <div class="container py-5">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-xl-10">
                <div class="card rounded-3 text-black">
                    <div class="row g-0">
                        
                        <div class="col-lg-6 d-flex align-items-center gradient-custom-2 order-2 order-lg-1">
                            <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                                <h4 class="mb-4">Intelligent Stock & Sales Analysis</h4>
                                <p class="small mb-0">Optimize your cleaning distribution with real-time data. Our platform provides deep insights into inventory levels, sales trends, and supply chain efficiency.</p>
                            </div>
                        </div>

                        <div class="col-lg-6 order-1 order-lg-2">
                            <div class="card-body p-md-5 mx-md-4">
                                <div class="text-center">
                                    <h4 class="mt-1 mb-5 pb-1">Create an Account</h4>
                                </div>

                                <?php if($error): ?> <div class="alert alert-danger py-2"><?= $error ?></div> <?php endif; ?>
                                <?php if($success): ?> <div class="alert alert-success py-2"><?= $success ?></div> <?php endif; ?>

                                <form action="register.php" method="POST">
                                    <p>Please fill in your details</p>

                                    <div data-mdb-input-init class="form-outline mb-4">
                                        <input type="text" name="name" id="name" class="form-control" placeholder="Full Name" required />
                                        <label class="form-label" for="name">Full Name</label>
                                    </div>

                                    <div data-mdb-input-init class="form-outline mb-4">
                                        <input type="email" name="email" id="email" class="form-control" placeholder="Email Address" required />
                                        <label class="form-label" for="email">Email</label>
                                    </div>

                                    <div data-mdb-input-init class="form-outline mb-4">
                                        <input type="password" name="password" id="password" class="form-control" required />
                                        <label class="form-label" for="password">Password</label>
                                    </div>

                                    <div data-mdb-input-init class="form-outline mb-4">
                                        <input type="password" name="confirm_password" id="confirm_password" class="form-control" required />
                                        <label class="form-label" for="confirm_password">Confirm Password</label>
                                    </div>

                                    <div class="text-center pt-1 mb-5 pb-1">
                                        <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit">Register</button>
                                    </div>

                                    <div class="d-flex align-items-center justify-content-center pb-4">
                                        <p class="mb-0 me-2">Already have an account?</p>
                                        <a href="login.php" class="btn btn-outline-info">Login</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.umd.min.js"></script>
</body>
</html>