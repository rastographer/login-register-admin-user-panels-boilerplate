<?php

    error_reporting(E_ALL);
    ini_set('display_errors', 'On');
    // Start or resume the session
    session_start();

    if(isset($_SESSION['user_mail'])){
        header('Location: user/dashboard.php');
    }

    // Include necessary files and initialize the Functions class
    include 'admin/db.php';
    include 'admin/functions.php';

    // Create an instance of the Functions class
    $functions = new Functions($conn);
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User - <?= $functions->getSetting('site_name'); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= $functions->getSetting('site_url'); ?>assets/styles/main.css">
</head>
<body>

<?php include 'partials/header.php'; ?> 

<div class="container d-flex justify-content-center align-items-center my-5">
    <div class="row g-5">
    <div class="col-sm-12 col-md-6" style="max-height:300px;">
        <img src="images/login_image.svg" alt="Login" class="img-fluid mx-auto d-block" style="max-width:250px;height:auto;">
        <h2 class="fw-bolder mb-2 text-center">Login or Register an Account</h2>
        <p class="text-muted mb-2 text-center">Access your dashboard to track previous purchases and access our support services</p>
    </div>
    <div class="col-sm-12 col-md-6">
    <div class="card shadow p-4 rounded-lg w-100">
        <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
            <li class="nav-item w-50" role="presentation">
                <button class="nav-link active w-100" id="login-tab" data-bs-toggle="tab" data-bs-target="#login" type="button" role="tab" aria-controls="login" aria-selected="true">Login</button>
            </li>
            <li class="nav-item w-50" role="presentation">
                <button class="nav-link w-100" id="register-tab" data-bs-toggle="tab" data-bs-target="#register" type="button" role="tab" aria-controls="register" aria-selected="false">Register</button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="login-tab">
                    <?php if(isset($_GET['err'])){ ?>
                        <p class="text-danger"><?= $_GET['err']; ?></p>
                    <?php } elseif (isset($_GET['msg'])) {?>
                        <p class="text-success"><?= $_GET['msg']; ?></p>
                    <?php } else {
                        $err = NULL;
                    }?>
                <form action="login.php" method="post">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email address">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="remember_me">
                            <label class="form-check-label" for="remember_me">Remember Me</label>
                        </div>
                        <a href="resetpassword.php">Forgot Password?</a>
                    </div>
                    <button type="submit" name="submit_login_details" class="btn btn-primary w-100">Login</button>
                </form>
            </div>
            <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab">
                <?php if(isset($_GET['err'])){ ?>
                    <p class="text-danger"><?= $_GET['err']; ?></p>
                <?php } elseif (isset($_GET['msg'])) {?>
                    <p class="text-success"><?= $_GET['msg']; ?></p>
                <?php } else {
                    $err = NULL;
                }?>
                <form action="register.php" method="post">
                    <div class="mb-3">
                        <label for="full_name" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Enter your full name">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email address">
                    </div>
                    <div class="mb-3">
                        <label for="whatsapp_number" class="form-label">WhatsApp Phone Number</label>
                        <input type="tel" class="form-control" id="whatsapp_number" name="whatsapp_number" placeholder="Enter your WhatsApp number">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
                    </div>
                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm your password">
                    </div>
                    <button type="submit" name="submit_registration_details" class="btn btn-primary w-100">Register</button>
                </form>
            </div>
        </div>
    </div>
    </div>
    </div>
</div>

<?php include 'partials/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>