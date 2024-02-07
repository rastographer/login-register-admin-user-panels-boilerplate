<?php 

session_start();
include '../admin/db.php';
include '../libs/input.php';
include 'user.php';

include '../libs/mailer.php'; // Include the mailer file

$user = new User($conn);


if(isset($_POST['submit_reset_password_request']) && !empty($_POST['email'])){
    $email = Input::sanitizeEmail($_POST['email']);

    $result = $user->passwordReset($email);
    $res = json_decode((string)$result);
    
    if($res->status == "success"){         
         $user_details = $user->getUser($email);

          // Compose the email data
        $data = [
            'to' => $email,
            'subject' => 'Password Reset',
            'template' => 'resetpassword_confirmation',
            'userFullName' => $user_details->full_name,
            'token' => $res->data,
        ];

        // Send the email
        send_mail($data);

        // return $result;
        echo "<script>window.location.href='changepassword.php?msg=$res->message'</script>";
        
    } else {
                
        echo "<script>window.location.href='resetpassword.php?err=$res->message'</script>";
    }


    
}



?>