<?php

//references: https://www.youtube.com/watch?v=9tD8lA9foxw

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load PHPMailer classes
require 'PhpMailSender/src/Exception.php';
require 'PhpMailSender/src/PHPMailer.php';
require 'PhpMailSender/src/SMTP.php';

// Create a new PHPMailer instance
$mail = new PHPMailer(true);

try {
    // SMTP configuration
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'tancs8803@gmail.com';
    $mail->Password = 'your_smtp_password';
    $mail->SMTPSecure = 'ssl'; // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 465; // TCP port to connect to

    // Email sender and recipient
    $mail->setFrom('tancs8803@gmail.com', 'Tan Choon Shen'); // my email
    $mail->addAddress('chinjunchen@gmail.com', 'Jeremy Chin'); // recipient email

    // Email subject and message
    $mail->Subject = 'Test Email using PHPMailer'; // subject
    $mail->Body = 'This is a test email sent using PHPMailer.'; // body message

    // Send email
    $mail->send();
    echo 'Email sent successfully.';
} catch (Exception $e) {
    echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
