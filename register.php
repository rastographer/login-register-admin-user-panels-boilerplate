<?php 

session_start();
include 'admin/db.php';
include 'libs/input.php';
include 'user/user.php';
include 'libs/mailer.php'; // Include the mailer file

$user = new User($conn);

if(isset($_POST['submit_registration_details']) && !empty($_POST['email'])){
    $fullName = Input::sanitizeString($_POST['full_name']);
    $email = Input::sanitizeEmail($_POST['email']);
    $whatsapp_number = Input::sanitizePhone($_POST['whatsapp_number']);
    $password = Input::sanitizeString($_POST['password']);
    $confirm_password = Input::sanitizeString($_POST['confirm_password']);
    $username = preg_replace('/\s+/', '', $fullName);
    $status = 'active';

    $result = $user->register($fullName, $username, $email, $whatsapp_number, $password, $confirm_password, $status);
    $res = json_decode((string)$result);

    if($res->status == "success"){

        $_SESSION['user_mail'] = $email;

        $to = $email;
        $subject = 'Welcome to [Name of Business]!';
        $template = 'registration_confirmation'; // Define the template for registration email

        $data = [
            'to' => $to,
            'subject' => $subject,
            'template' => $template,
            'userFullName' => $fullName,
            // Add more data as needed for the email template
        ];

        // Send the registration email
        send_mail($data);
        
        header('Location: dashboard.php?msg=' . $res->message);
    } else {
        header('Location: index.php?err=' . $res->message);
    }
}