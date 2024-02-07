<?php

    error_reporting(E_ALL);
    ini_set('display_errors', 'On');
    // Start or resume the session
    session_start();

    if(isset($_SESSION['user_mail'])){
        header('Location: dashboard.php');
    } else {

        // Include necessary files and initialize the Functions class
    include '../admin/db.php';
    include '../admin/functions.php';
    include 'user.php';

    $user = new User($conn);

    // Create an instance of the Functions class
    $functions = new Functions($conn);

        if(isset($_POST['submit_reset_code']) && !empty($_POST['token'])){
            $token = $_POST['token'];
            $newPassword = $_POST['new_password'];
            $confirmPassword = $_POST['confirm_password'];

            $result = $user->verifyResetPasswordCode($token, $newPassword, $confirmPassword);
            $res = json_decode((string)$result);
            
            if($res->status == 'success'){
                
                echo "<script>window.location.href='index.php?msg=$res->message'</script>";
                                
            } else {
                
                echo "<script>window.location.href='changepassword.php?err=$res->message'</script>";
                
            }
        }

    } 


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

<?php include '../partials/header.php'; ?> 

<div class="container d-flex justify-content-center align-items-center my-5">
  <div class="row g-5">
    <div class="col-sm-12 col-md-6 my-5" style="max-height:300px;">
      <img src="../images/reset_password.svg" alt="Reset Password" class="img-fluid mx-auto d-block" style="max-width:250px;height:auto;">
      <h2 class="fw-bolder mb-2 text-center">Reset your Password</h2>
      <p class="text-muted mb-2 text-center">Don't worry, it happens to the best of us. We have sent you the reset code via Email, you may have to chek the spam/junk folder to find it.</p>
    </div>
    <div class="d-flex align-items-center col-sm-12 col-md-6">
      <div class="card shadow p-4 rounded-lg w-100">
            <?php if(isset($_GET['err'])){ ?>
                <p class="text-danger"><?= $_GET['err']; ?></p>
            <?php } elseif (isset($_GET['msg'])) {?>
                <p class="text-success"><?= $_GET['msg']; ?></p>
            <?php } else {
                $err = NULL;
            }?>
        <form action="" method="post">
          <div class="mb-3">
            <label for="token" class="form-label">Paste The Reset Code Here:</label>
            <input type="text" class="form-control" id="token" name="token" placeholder="Enter verification code" required>
          </div>
          <div class="mb-3">
            <label for="new_password" class="form-label">New Password:</label>
            <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Enter new password" required>
          </div>
          <div class="mb-3">
            <label for="confirm_password" class="form-label">Confirm Password:</label>
            <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Enter password again" required>
          </div>
          <button type="submit" name="submit_reset_code" class="btn btn-primary w-100">Complete Reset Password</button>
        </form>
      </div>
    </div>
  </div>
</div>


<?php include '../partials/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>