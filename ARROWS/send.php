<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';
require './PHPMailer/src/Exception.php';

$mail = new PHPMailer(true);

if(isset($_POST['submit'])){
    $email = $_POST['email'];

    try{
         //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'iarrownet@gmail.com';                     //SMTP username
    $mail->Password   = 'wmnaiprhsffsxxyk';                               //SMTP password
    $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
    $mail->Port       = 587; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom($email, 'ARROWNET');
    $mail->addAddress($email);
    $mail->addAddress('keithkelly986@gmail.com', 'Customer Care');     //Add a recipient


//Attachments
$mail->addAttachment('./images/ARROWNET.png'); //Add attachments

//Content
$mail->isHTML(true);                                  //Set email format to HTML
$mail->Subject = 'New Member';
$mail->Body    = 'Welcome '.$email.'<br/>We appreciate you for signing up to our arrownet feeds.Here you will learn more about us.We will be sharing our reports about our outreach services, offices and other exciting news and places we have ventured.<br/> Thank you for signing up be sure to get updates from us.<br/><br/>Your sincerely.<br/>Arrownet.';

$mail->send();
echo "<script>alert('Thank you $email for signing up to our arrownet feeds.We will get in touch with you soon!');</script>";
echo "<script>window.location.href='arrows.html'</script>";
    }catch(Exception $e){
        echo "<script>alert('Message could not be sent. Mailer Error: {$mail->ErrorInfo}');</script>";
        header('location: arrows.html');
    };
}
?>