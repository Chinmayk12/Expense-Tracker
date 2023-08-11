<?php

//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once 'vendor/autoload.php';

$mail = new PHPMailer(true);
$mail->isSMTP();
$mail->SMTPAuth = true;
//to view proper logging details for success and error messages
// $mail->SMTPDebug = 1;
$mail->Host = 'smtp.gmail.com'; //gmail SMTP server
$mail->Username = 'karodpatichinmay12@gmail.com'; //email
$mail->Password = 'hnunxrihozrtcgkf'; //16 character obtained from app password created
$mail->Port = 465; //SMTP port
$mail->SMTPSecure = "ssl";

//sender information
$mail->setFrom('karodpatichinmay12@gmail.com', 'Chinmay');

//receiver address and name
$mail->addAddress('karodpatichinmay143@gmail.com', 'Chinmay');

// Add cc or bcc
//$mail->addCC('aniketpatil6448@gmail.com');
// $mail->addBCC('user@mail.com');
//$mail->addAttachment(_DIR_ . '/download.png');
// $mail->addAttachment(_DIR_ . '/exampleattachment2.jpg');


$mail->isHTML(true);

$mail->Subject = "Reset Code";
$mail->Body ='bye';

// Send mail
if (!$mail->send()) {
    echo 'Email not sent an error was encountered: ' . $mail->ErrorInfo;
    echo "<script> alert('Something Went Wrong'); window.location='index.php'; </script>";
} else 
{
    echo "<script>alert('Successful', 'Mail Sended!', true);</script>";
}

$mail->smtpClose();
?>