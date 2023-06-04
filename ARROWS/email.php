<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);    

if(isset($_POST['submit'])){
$email = $_POST['email'];
$phone = $_POST['phone'];
$subject = $_POST['subject'];
$message = $_POST['message'];

try{
$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
$mail->isSMTP();                                            //Send using SMTP
$mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
$mail->Username   = '';                     //SMTP username
$mail->Password   = '';    
$mail->SMTPSecure = 'tls';
$mail->Port       = 587;

$mail->setFrom($email, 'ARROW NET');
$mail->addAddress($email);  
$mail->addAddress('', 'Customer care');
$mail->addCC($email);

$mail->isHTML(true);                                  //Set email format to HTML
$mail->Subject = $subject;
$mail->Body    = 'Phone number: '.$phone. '<br/> From: ' .$email. '<br/><br/> Subject: ' .$subject. ' <br/><br/><br/>' .$message;

$mail->send();
    echo "<script>alert('Message has been sent!');</script>";
    echo "<script>window.location.href='arrows.html'</script>";
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

 }                 
  

?>