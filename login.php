<?php 

session_start();
include 'admin/db.php';
include 'libs/input.php';
include 'user/user.php';

$user = new User($conn);

if(isset($_POST['submit_login_details']) && !empty($_POST['email'])){
    $email = Input::sanitizeEmail($_POST['email']);
    $password = Input::sanitizeString($_POST['password']);

    $result = $user->login($email, $password);
    $res = json_decode((string)$result);
    
    if($res->status == "success"){
        $_SESSION['user_mail'] = $email;

        header('Location: user/dashboard.php?msg=' . $res->message);
    } else {
        header('Location: index.php?err=' . $res->message);
    }


    
}