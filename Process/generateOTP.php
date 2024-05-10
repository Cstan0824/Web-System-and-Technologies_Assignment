<?php

//references: https://www.youtube.com/watch?v=9tD8lA9foxw
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PhpMailSender/src/Exception.php';
require '../PhpMailSender/src/PHPMailer.php';
require '../PhpMailSender/src/SMTP.php';

$mail = new PHPMailer(true);

try {
    // Generate OTP
    $otp = generateOTP();

    // Store OTP in session
    $_SESSION['otp'] = $otp;

    // SMTP configuration
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'tarumtmoviesociety@gmail.com'; //password: moviesociety1234
    $mail->Password = 'hqcqfvfedfuixvit'; //app name: Movie Society
    $mail->SMTPSecure = 'ssl'; //TLS or SSL secure connection
    $mail->Port = 465; //TCP port

    // Email sender and recipient
    $mail->setFrom('tarumtmoviesociety@gmail.com', 'TARUMT Movie Society');// sender
    $mail->addAddress($email, $name); // recipient

    //Content
    $mail->isHTML(true);

    $mail->Subject = 'Member Account Registration';
    $mail->Body = "<h2>Dear $name, <br/><br/> Thank you for registering with us. 
     <br/>Your OTP No. is <span style='color:red;'>$otp</span> for <strong>Movie Society</strong> and will expire in 5 minutes.</h2>
    <br/> <b>REMARK: DO NOT SHARE THIS OTP TO ANYONE.</b> <br/> <br/> 
    Best Regards, <br/> <b>TARUMT Movie Society</b> <br/>";

    $mail->send();
} catch (Exception $e) {
    echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

function generateOTP()
{
    // Generate a random 6-digit OTP
    $otp = rand(100000, 999999);
    return $otp;
}
