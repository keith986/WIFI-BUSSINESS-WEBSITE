<?php
$email = $_POST['email'];
$overall = $_POST['overall'];
$overall2 = $_POST['overall2'];
$overall3 = $_POST['overall3'];
$overall4 = $_POST['overall4'];
$detail = $_POST['detail'];
$public = $_POST['public'];
$problem = $_POST['problem'];
$comments = $_POST['comments'];

$conn = new mysqli('localhost','root','','form');

if($conn->connect_error){
    die('Failed!!Connection error'.$conn->connect_error);
}else{
    $stmt = "insert into survey(email,overall,overall2,overall3,overall4,detail,public,problem,comments)
values('$email','$overall','$overall2','$overall3','$overall4','$detail','$public','$problem','$comments')";
if($conn->query($stmt)){
    echo "<script>alert('You have successfully submitted your survey!!');</script>";
    echo "<script>window.location.href='arrows.html';</script>";
}else{
    echo "<script>alert('Something went wrong!!Please try again!!');</script>";
};
}

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
$mail->Subject = 'ArrowNet Survey';
$mail->Body    = 'Thank you '.$email.' for taking your time to complete our survey!<br/>We appreciate your effort for taking part and your loyalty to arrownet.We will get back to you soon.<br/>Mean while you can sign up tp our arrownet feeds.Check out in our webpage and be updated on our progress.<br/><br/>Your sincerely.<br/>Arrownet.';

$mail->send();
echo "<script>window.location.href='arrows.html'</script>";
    }catch(Exception $e){
        echo "<script>alert('Message could not be sent. Mailer Error: {$mail->ErrorInfo}');</script>";
        header('location: survey.html');
    };
}

?>