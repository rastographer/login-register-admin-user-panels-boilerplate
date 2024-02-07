<?php 

session_start();

if(!isset($_SESSION['user_mail'])){
    header('Location: index.php');
    exit;
}

include '../admin/db.php';
include '../libs/input.php';
include 'user.php';

$user = new User($conn);
$user_details = $user->getUser($_SESSION['user_mail']);
$user_id = $user_details->id;

if(isset($_POST['submit_profile_details']))
{
    $fullName = Input::sanitizeString($_POST['name']);
    $username = Input::sanitizeString($_POST['username']);
    $whatsapp_number = Input::sanitizePhone($_POST['phoneNumber']);
    $password = Input::sanitizeString($_POST['password']);
    $confirm_password = Input::sanitizeString($_POST['confirm_password']);

    if ($newPassword !== $confirmPassword) {
        $err = "Passwords do not match";
        header('Location: dashboard.php?content=my-profile&err=' . $err);
    } else {
        $result = $user->editProfile($user_id, $fullName, $username, $whatsapp_number, $password);
        $res = json_decode((string)$result);

        if($res->status == "success"){
                
            header('Location: dashboard.php?content=my-profile&msg=' . $res->message);

        } else {
            header('Location: dashboard.php?content=my-profile&err=' . $res->message);
        }
    }


}