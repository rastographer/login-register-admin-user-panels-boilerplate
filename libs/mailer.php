<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


/// Send Mail Function Starts ///
function send_mail($data){

   require_once "../vendor/autoload.php";
 
   $mail = new PHPMailer();

   
   $site_name  = "";
   $site_email = "";
   $site_url   = "";
   $site_logo  = "";
   $s_currency = "";

   try {

//   $mail->SMTPDebug = SMTP::DEBUG_SERVER;
//   $mail->SMTPDebug = 2;
   $mail->isSMTP();
   $mail->Host = '';
   $mail->Port = '';
   $mail->SMTPAuth = true;
   $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
   $mail->Username = '';
   $mail->Password = '';

   $mail->CharSet = 'UTF-8';
   $mail->setFrom($site_email,$site_name);
   $mail->addAddress($data['to']);
   $mail->addReplyTo($site_email,$site_name);
   
   $mail->isHTML(true);

   $mail->Subject = $data['subject'];
   $mail->Body = load_view($data['template'],$data);

   if($mail->send()){ 
      return true;
   }

   } catch(Exception $e){
      print_r($e->getMessage());
      error_log($e->getMessage());
   }
 
 }
 
   /// Send Mail Function Ends ///
   function load_view($file,$data=''){
         
   $file = $data['template']; 

   ob_start();
   require("../emails/templates/en/$file.php");
   return ob_get_clean();
   }

?>